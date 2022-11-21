<?php
return [
    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],

    'user/login' => [
        'controller' => 'user',
        'action' => 'login'
    ],

    'user/logout' => [
        'controller' => 'user',
        'action' => 'logout'
    ],

    'user/register' => [
        'controller' => 'user',
        'action' => 'register'
    ],

    'file' => [
        'controller' => 'files',
        'action' => 'index'
    ],

    'file/upload' => [
        'controller' => 'files',
        'action' => 'upload'
    ],

    'file/delete' => [
        'controller' => 'files',
        'action' => 'delete'
    ],

    'file/delete/all' => [
        'controller' => 'files',
        'action' => 'deleteAll'
    ],

    'file/download' => [
        'controller' => 'files',
        'action' => 'download'
    ]
];