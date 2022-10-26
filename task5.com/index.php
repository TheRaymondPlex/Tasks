<?php

use application\core\Router;
use application\lib\DotEnv;

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class . '.php');

    if (file_exists($path)) {
        require $path;
    }
});

(new DotEnv(__DIR__ . '/.env'))->load();
require_once '../vendor/autoload.php';

session_start();

$router = new Router;
$router->run();
