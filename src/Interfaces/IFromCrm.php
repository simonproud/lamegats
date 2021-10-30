<?php

namespace SimonProud\Lamegats\Interfaces;

interface IFromCrm
{
    public function makeCall(); // создать звонок
    public function accounts(); // список сотрудников внесённых в телефонию
    public function history(); // список звонков
}