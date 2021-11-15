<?php

namespace SimonProud\Lamegats\Interfaces;

interface CallableClient
{
    public function getName():string;
    public function calls();
    public function lastCall();
}