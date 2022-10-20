<?php

return [
    '' => [
        'controller' => 'main',
        'action' => 'index',
        'param' => '1'
    ],

    '([0-9]+)' => [
        'controller' => 'main',
        'action' => 'index',
        'param' => '1'
    ],

    'user/create' => [
        'controller' => 'user',
        'action' => 'create',
    ],

    'user/edit/([0-9]+)' => [
        'controller' => 'user',
        'action' => 'edit',
        'param' => ''
    ],

    'user/update' => [
        'controller' => 'user',
        'action' => 'update'
    ],

    'user/delete/([0-9]+)' => [
        'controller' => 'user',
        'action' => 'delete',
        'param' => ''
    ]
];