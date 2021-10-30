<?php
Route::post(config('vats.entrypoint'), ['as' => 'ats.index',
    'uses' => SimonProud\Lamegats\Controllers\ATSController::class.'@index'
]);
