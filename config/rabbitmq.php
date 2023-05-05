<?php

use Illuminate\Support\Facades\Facade;
use Ite\IotCore\Providers\CoreProvider;

return [

    'exchanges' => [
        [
            'name' => 'user-activity',
            'type' => 'direct',
            'passive' => false,
            'durable' => false,
            'auto_delete' => false
        ]
    ],

    'queues' => [
        [
            'name' => 'blocked-users',
            'exchange' => 'user-activity',
            'bind' => 'blocked'
        ],
        [
            'name' => 'roles-updated-users',
            'exchange' => 'user-activity',
            'bind' => 'roles-updated'
        ]
    ]

];
