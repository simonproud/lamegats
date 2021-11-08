<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Base url
    |--------------------------------------------------------------------------
    */
    'timeout' => 2.0,
    'entrypoint' => '/api/ats/entrypoint',
    'api_prefix' => '/api/lamegats',
    'drivers' => [
        'megafon' => SimonProud\Lamegats\Drivers\Megafon\Driver::class
    ],
    'clients' => [
        //Client classes User::class => 'phone field'
        'user' => \App\Models\User::class,
        'lead' => \Modules\Lead\Entities\Lead::class
    ],
    'find_token' => [
        SimonProud\Lamegats\Drivers\Megafon\Driver::class.'@_vatsFindToken',
    ],
    'table_names' => [
        'vats_systems' => 'lg_vats_systems',
        'accounts' => 'lg_accounts',
        'events' => 'lg_events',
        'calls' => 'lg_calls',
    ],
    /**
     * DO NOT CHANGE
     */
    'response_keys' => [
        'megafon' => [
            'account' => ['identifier' => 'name']
        ]
    ],
];