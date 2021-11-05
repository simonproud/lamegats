<?php

namespace SimonProud\Lamegats\Interfaces;

interface IVatsClient
{
    public static function getByVats(string $phone, string $user):self|null;
}