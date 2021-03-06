<?php

namespace SimonProud\Lamegats\Drivers\Megafon\Services;


use Exception;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use SimonProud\Lamegats\Drivers\Megafon\Contracts\IAtsToCrm;

use SimonProud\Lamegats\Drivers\Megafon\Models\Call as ATSCall;
use SimonProud\Lamegats\Interfaces\IDriver;
use SimonProud\Lamegats\Interfaces\IToCrm;
use SimonProud\Lamegats\Interfaces\IVatsClient;
use SimonProud\Lamegats\Models\Account;
use SimonProud\Lamegats\Models\Call;
use SimonProud\Lamegats\Models\Event;
use SimonProud\Lamegats\Models\VatsSystem;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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
    public function history($body):void
    {
        try {
            $call = new ATSCall($body->all());
            foreach (config('vats.clients') as $class){
                if(new $class instanceof IVatsClient){
                    $client = $class::getByVats($call->getPhone(), $call->getUser());
                    if($client instanceof $class){
                        break;
                    }
                }
                else{
                    \Illuminate\Support\Facades\Log::error('Wrong instance '.$class.'. Class must implement '.IVatsClient::class);
                    throw new Exception('Wrong instance '.$class.'. Class must implement '.IVatsClient::class);
                }
            }
            $data = [
                'vats_systems_id' => $this->vatsSystem->id,
                'type' => $call->getType(),
                'account_id' => Account::findByVatsIdentifier($this->vatsSystem, $call->getUser())->id,
                'call_id' => $call->getCallid(),
                'client_type' => get_class($client),
                'client_id' => $client->id,
                'record' => $call->getLink(),
                'phone' => $call->getPhone(),
                'duration' => $call->getDuration(),
                'status' => $call->getStatus(),
                'start' => Carbon::parse($call->getStart()),
            ];

            Call::create($data);
        }catch (Exception $exception){

        }

    }

    /**
     * @param $body
     * @return mixed
     * @throws Exception
     */
    public function event($body):void
    {
        try {
            $event = new EventAts($body->all());
            $client = null;
            foreach (config('vats.clients') as  $class){
                if(new $class instanceof IVatsClient){
                    $client = $class::getByVats($event->getPhone(), $event->getUser());
                    if($client instanceof $class){break;}
                }
                else{

                    \Illuminate\Support\Facades\Log::error('Wrong instance '.$class.'. Class must implement '.IVatsClient::class);
                    throw new Exception('Wrong instance '.$class.'. Class must implement '.IVatsClient::class);
                }
            }
            $all = $body->all();
            unset($all['driver']);
            unset($all['crm_token']);
            $data = [
                'type' => $event->getType(),
                'client_type' => get_class($client),
                'client_id' => $client->id,
                'vats_systems_id' => $this->vatsSystem->id,
                'call_id' => $event->getCallid(),
                'account_id' => Account::findByVatsIdentifier($this->vatsSystem, $event->getUser())->id,
                'full_request' => json_encode($all)
            ];
            Event::create($data);
        }catch (Exception $exception){
            \Illuminate\Support\Facades\Log::error($exception->getMessage(), $exception->getTrace());
        }
    }

    /**
     * @param $body
     * @return mixed
     */
    public function contact($body):void
    {
        // TODO: Implement contact() method.
    }

    public function index(Request $request)
    {
        // TODO: Implement index() method.
    }
}