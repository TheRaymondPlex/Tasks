<?php

use application\core\Router;
use application\lib\DotEnv;

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');

    if (file_exists($path)) {
        require $path;
    }
});

session_start();

(new DotEnv(__DIR__ . '/.env'))->load();

$router = new Router;
$router->run();

//echo 'test';

