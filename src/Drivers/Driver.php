<?php

namespace SimonProud\Lamegats\Drivers;

use SimonProud\Lamegats\Interfaces\IDriver;
use SimonProud\Lamegats\Interfaces\ITokenized;

abstract class Driver implements IDriver, ITokenized
{

    protected array $availableFunctions;

    public function __construct($config)
    {
    }
}