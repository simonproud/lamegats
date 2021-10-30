<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Base url
    |--------------------------------------------------------------------------
    */
    'timeout' => 2.0,
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