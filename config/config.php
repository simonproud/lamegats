<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Base url
    |--------------------------------------------------------------------------
    */
    'timeout' => 2.0,
    'entrypoint' => '/api/ats/entrypoint',
    'drivers' => [
        'megafon' => SimonProud\Lamegats\Drivers\Megafon\Driver::class
    ],
    'find_token' => [
        SimonProud\Lamegats\Drivers\Megafon\Driver::class.'@_vatsFindToken',
    ],
    'table_names' => [
        'vats_systems' => 'lg_vats_systems',
        'accounts' => 'lg_accounts',
        'events' => 'lg_events',
        'calls' => 'lg_calls',
    ]
];