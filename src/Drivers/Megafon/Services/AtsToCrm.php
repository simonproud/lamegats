<?php

namespace SimonProud\Lamegats\Drivers\Megafon\Services;


use Illuminate\Http\Request;
use SimonProud\Lamegats\Drivers\Megafon\Contracts\IAtsToCrm;
use SimonProud\Lamegats\Interfaces\IToCrm;

class AtsToCrm implements IAtsToCrm, IToCrm
{

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
        // TODO: Implement event() method.
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