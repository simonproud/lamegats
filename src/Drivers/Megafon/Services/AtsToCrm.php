<?php

namespace SimonProud\Lamegats\Drivers\Megafon\Services;


use Illuminate\Http\Request;
use SimonProud\Lamegats\Drivers\Megafon\Contracts\IAtsToCrm;
use SimonProud\Lamegats\Interfaces\IDriver;
use SimonProud\Lamegats\Interfaces\IToCrm;
use SimonProud\Lamegats\Models\Event;
use SimonProud\Lamegats\Models\VatsSystem;

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
        // TODO: Implement history() method.
    }

    /**
     * @param $body
     * @return mixed
     */
    public function event($body)
    {
        $data = [
            'vats_systems_id' => $this->vatsSystem->id,
            'call_id' => $body['callId']
        ];
        Event::create();
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