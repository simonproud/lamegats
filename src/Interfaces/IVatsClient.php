<?php

namespace SimonProud\Lamegats\Interfaces;

interface IVatsClient
{
    public static function getByVats(string $phone, string|null $user):self|null;
}