<?php

use application\core\Router;
use application\lib\DotEnv;

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');

    if (file_exists($path)) {
        require $path;
    }
});

try {
    if (!file_exists('vendor/autoload.php')) {
        throw new Exception("File vendor/autoload.php was not found in project folder!");
    }
    require_once 'vendor/autoload.php';
} catch (Exception $exception) {
    echo $exception->getMessage();
    die();
}

session_start();

(new DotEnv(__DIR__ . '/.env'))->load();

$router = new Router;
$router->run();