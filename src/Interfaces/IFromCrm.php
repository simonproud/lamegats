<?php

namespace SimonProud\Lamegats\Interfaces;

interface IFromCrm
{
    public function makeCall($params = [], $method = 'POST', $headers = []); // создать звонок
    public function accounts(); // список сотрудников внесённых в телефонию
    public function history(); // список звонков
}