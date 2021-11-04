<?php

namespace SimonProud\Lamegats\Drivers\Megafon;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use http\Env\Request;
use SimonProud\Lamegats\Drivers\Megafon\Maps\ResponseMap;
use SimonProud\Lamegats\Exception\TokenExpectedException;
use SimonProud\Lamegats\Exception\URIExcectedException;
use SimonProud\Lamegats\Drivers\Megafon\Services\AtsToCrm;
use SimonProud\Lamegats\Drivers\Megafon\Services\CrmToAts;
use SimonProud\Lamegats\Exception\MethodNotFoundException;
use SimonProud\Lamegats\Interfaces\IFromCrm;
use SimonProud\Lamegats\Interfaces\IToCrm;
use SimonProud\Lamegats\Interfaces\ITokenized;
use SimonProud\Lamegats\Models\VatsSystem;

class Driver extends \SimonProud\Lamegats\Drivers\Driver implements ITokenized
{
    /**
    * Configuration
    * @var array
    */
    public array $config;
    /**
     * @var CrmToAts
     */
    protected CrmToAts $crmToAts;
    /**
     * @var AtsToCrm
     */
    protected AtsToCrm $atsToCrm;
    /**
     * @comment Guzzle defacto standard.
     * @var Client
     */
    public Client $client;
    /**
     * @var string
     */
    public string $baseUri;
    /**
     * @var string
     */
    protected string $token;

    public $availableFunctions;

    /**
     *
     * MegafonVirtualAts constructor.
     * @param VatsSystem $vatsSystem
     * @throws TokenExpectedException
     * @throws URIExcectedException
     */
    public function __construct(VatsSystem $vatsSystem)
    {
        $config = $vatsSystem->toArray();
        parent::__construct($config);
        if(isset($config['clean']) && $config['clean'] != true || !isset($config['clean'])){
        // Если есть в конфиге, берем оттуда, если нету, читаем из конфига
        $baseURI = $config['base_uri'];
        if (!$baseURI) {
            throw new URIExcectedException('Base uri expected.');
        }

        // Если нету токена, выбрасываем исключение.
        if (!(isset($config['token']))){
            throw new TokenExpectedException('Token expected.');
        }
        // Делаем массив доступных методов и выпиливаем методы начинающиеся на __, _vats
        $this->availableFunctions = collect(explode(',',implode(',',get_class_methods(CrmToAts::class)).','))->filter(function($item){
            if(!$item) {return false;}
            if(str_contains($item, '__')) {return false;}
            if(str_contains($item, '_vats')) {return false;}
            return true;
        })->toArray();

        $this->setToken($config['token']);
        $this->setBaseUri($baseURI);

        $this->client = new Client($config);

        $this->setCrmToAts(new CrmToAts($this->client, ['token' => $config['auth_token'], 'base_uri' => $baseURI]));
        $this->setAtsToCrm(new AtsToCrm($this, VatsSystem::find($config['id'])));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return string
     * @throws \Exception
     */
    public static function _vatsFindToken(\Illuminate\Http\Request $request):?string
    {
        if(isset($request->crm_token)){
            return $request->crm_token;
        }
        return null;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws MethodNotFoundException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __call($name, $arguments)
    {

        if (!(in_array($name, $this->availableFunctions))) {
            throw new MethodNotFoundException('Method ' . $name . ' not found in API');
        }

        // Если передали в качестве первого аргумента строку, значит меняем метод отправки на указанный
        $method = (isset($arguments[0]) &&is_string($arguments[0])) ? $arguments[0] : 'POST';
        // Если первый аргумент boolean, значит нам нужно получить полноценный Guzzle/Response Object
        $need_response_object = (isset($arguments[0]) && is_bool($arguments[0]) && $arguments[0] === true);
        // Если первый аргумент это массив, значит нужно передать это в параметры
        $params = (isset($arguments[0]) && is_array($arguments[0])) ? $arguments[0] : [];

        // Decorator
        // Наверняка это можно сделать лучше
        // Если первым параметром Arguments[0] передали true, вернем полноценный объект
        if ($need_response_object && method_exists($this->atsToCrm, $name))
        {
            return call_user_func_array([$this->atsToCrm, $name], [array_merge($params, ['cmd' => $name, 'token' => $this->getToken()]), $method]);
        }

        if ($need_response_object &&  method_exists($this->crmToAts, $name))
        {
            return call_user_func_array([$this->crmToAts, $name], [array_merge($params, ['cmd' => $name, 'token' => $this->getToken()]), $method]);
        }

        try {
            $res = $this->client->request($method, $this->config, ['form_params'=> array_merge($params, ['cmd' => $name, 'token' => $this->getToken()])])->getBody();
            $res = json_decode($res);
        }catch (ClientException $e) {
            $res =  json_decode($e->getResponse()->getBody());
        }catch (ServerException $e){
            $res = 'Server error!';
        }

        return $res;


    }

    /**
     * @return mixed
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param mixed $baseUri
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @return mixed
     */
    public function getCrmToAts(): IFromCrm
    {
        return $this->crmToAts;
    }

    /**
     * @param mixed $crmToAts
     */
    public function setCrmToAts(IFromCrm $crmToAts)
    {
        $this->crmToAts = $crmToAts;
    }
    /**
     * @return mixed
     */
    public function getAtsToCrm(): AtsToCrm
    {
        return $this->atsToCrm;
    }

    /**
     * @param mixed $atsToCrm
     */
    public function setAtsToCrm(IToCrm $atsToCrm)
    {
        $this->atsToCrm = $atsToCrm;
    }

    public function getCommand(\Illuminate\Http\Request $request): string
    {
        if(isset($request->cmd)){
            return $request->cmd;
        }
        throw new \Exception('Failed Command');
    }

}