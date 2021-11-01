<?php

namespace SimonProud\Lamegats\Facades;

use SimonProud\Lamegats\Drivers\Megafon\Services\CrmToAts;
use SimonProud\Lamegats\Models\VatsSystem;

class Lamegats
{
    private VatsSystem $vats;
    private array $availableFunctions;
    public function __construct(VatsSystem $vats)
    {
        $this->vats = $vats;

        $driver = $vats->driver;
        if(class_exists($driver)){
        $this->availableFunctions = collect(explode(',',implode(',',get_class_methods($driver)).','))->filter(function($item){
            if(!$item) {return false;}
            if(str_contains($item, '__')) {return false;}
            if(str_contains($item, '_vats')) {return false;}
            return true;
        })->toArray();

        }else{
            throw new \Exception('vats driver except');
        }
    }



}