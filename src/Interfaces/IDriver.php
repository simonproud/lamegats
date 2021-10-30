<?php

namespace SimonProud\Lamegats\Interfaces;
use Illuminate\Http\Request;

interface IDriver
{
    public function getCrmToAts():IFromCrm;
    public function setCrmToAts(IFromCrm $crmToAts);
    public function getAtsToCrm():IToCrm;
    public function setAtsToCrm(IToCrm $crmToAts);
    public function getCommand(Request $request):string;
}