<?php
Route::post('/api/ats/entrypoint', ['as' => 'ats.index',
    'uses' => SimonProud\Lamegats\Controllers\ATSController::class.'@index'
]);
