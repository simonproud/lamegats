<?php

namespace SimonProud\Lamegats\Interfaces;
use Illuminate\Http\Request;

interface ITokenized
{
  public static function _vatsFindToken(Request $request);
}