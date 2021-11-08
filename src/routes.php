<?php
Route::any(config('vats.entrypoint'), ['as' => 'ats.index',
    'uses' => SimonProud\Lamegats\Controllers\ATSController::class.'@index'
]);

Route::post(config('vats.api_prefix').'/calls/{account}/make', \SimonProud\Lamegats\Controllers\CallController::class.'@makeCall',  array("as" => "api"));
Route::apiResource(config('vats.api_prefix').'/calls', \SimonProud\Lamegats\Controllers\CallController::class,  array("as" => "api"));
