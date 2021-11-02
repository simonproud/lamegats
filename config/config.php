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
    'clients' => [
        //Client classes User::class => 'phone field'
        \App\Models\User::class => 'phone@+',
        \Modules\Lead\Entities\Lead::class => 'contact@+'
    ],
    'create_if_clients_not_exists' => \Modules\Lead\Entities\Lead::class.'@contact@+',
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