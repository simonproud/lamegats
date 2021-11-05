<?php

namespace SimonProud\Lamegats\Controllers;

use Illuminate\Http\Request;
use Event;
use Log;
use SimonProud\Lamegats\Interfaces\IDriver;
use SimonProud\Lamegats\Interfaces\ITokenized;
use SimonProud\Lamegats\Models\VatsSystem;

class ATSController extends \App\Http\Controllers\Controller implements \SimonProud\Lamegats\Drivers\Megafon\Contracts\IAtsToCrm
{

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $tokens = $this->findToken($request);
        if(count($tokens) == 0){
            \Illuminate\Support\Facades\Log::error('Token not found');
            throw new \Exception('Token not found');
        }
        if(count($tokens) > 1){
            \Illuminate\Support\Facades\Log::error('multiple tokens finded. Please modify drivers for except it');
            throw new \Exception('multiple tokens finded. Please modify drivers for except it');
        }

        $vats = VatsSystem::findByTokenAndName($tokens[0], config('vats.drivers.'.$request->driver));
        if($vats instanceof VatsSystem && $vats->driver != null && class_exists($vats->driver)){
            $driverClass =  $vats->driver;
            $driver = new $driverClass($vats);
        }else{
            \Illuminate\Support\Facades\Log::error('driver or vats for token and name is not exists');
            throw new \Exception('driver or vats for token and name is not exists');
        }

        $command = $driver->getCommand($request);
        if($driver instanceof IDriver){
            $driver->getAtsToCrm()->$command($request);
        }
        //_log(collect($request->all())->toJson(), 'megafon_api', true);
         \Log::debug('Request from megafon', ['body request' => $request->all()]);
    }

    private function findToken(Request $request):array
    {
        $tokens = [];
        foreach (config('vats.find_token') as $vats){
            [$class, $method] = explode('@', $vats);
            if(method_exists($class, $method)){
                $tokens[] = $class::$method($request);
            }
        }
        return $tokens;
    }
}
