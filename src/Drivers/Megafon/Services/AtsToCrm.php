<?php

namespace SimonProud\Lamegats\Drivers\Megafon\Services;


use Exception;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use SimonProud\Lamegats\Drivers\Megafon\Contracts\IAtsToCrm;
use SimonProud\Lamegats\Drivers\Megafon\Models\Call;
use SimonProud\Lamegats\Interfaces\IDriver;
use SimonProud\Lamegats\Interfaces\IToCrm;
use SimonProud\Lamegats\Models\Account;
use SimonProud\Lamegats\Models\Event;
use SimonProud\Lamegats\Models\VatsSystem;
use Illuminate\Database\Eloquent\Model;
use \SimonProud\Lamegats\Drivers\Megafon\Models\Event as EventAts;
class AtsToCrm implements IAtsToCrm, IToCrm
{

    private IDriver $driver;
    private VatsSystem $vatsSystem;
    public function __construct(IDriver $driver, VatsSystem $vatsSystem)
    {
        $this->driver = $driver;
        $this->vatsSystem = $vatsSystem;
    }

    /**
     * @param $body
     * @return mixed
     */
    public function history($body)
    {
        $call = new Call($body->all());

    }

    /**
     * @param $body
     * @return mixed
     * @throws Exception
     */
    public function event($body)
    {
        $event = new EventAts($body);
        $client = null;
        foreach (config('vats.clients') as $class => $row){
            [$field, $modifier] = explode('@', $row);
            if(new $class instanceof Model){
                $client = $class::where($field, '=', $modifier.$body['phone'])->first();
                if($client instanceof $class){
                    break;
                }
            }
            else{
                throw new Exception('Wrong instance '.$class);
            }
        }
        if($client === null){
            [$clientClass, $field, $modifier] = explode('@', config('vats.create_if_clients_not_exists'));
            if(new $clientClass instanceof Model){
                $client = $clientClass::create([$field => $modifier.$body['phone'], 'comment' => 'vats']);
            }
        }
        $data = [
            'type' => $event->getType(),
            'client_type' => get_class($client),
            'client_id' => $client->id,
            'vats_systems_id' => $this->vatsSystem->id,
            'call_id' => $event->getCallid(),
            'account_id' => Account::findByVatsIdentifier($this->vatsSystem, $event->getUser())->id,
            'full_request' => $body
        ];
        return Event::create($data);
    }

    /**
     * @param $body
     * @return mixed
     */
    public function contact($body)
    {
        // TODO: Implement contact() method.
    }

    public function index(Request $request)
    {
        // TODO: Implement index() method.
    }
}