<?php
session_start();

use application\core\Router;
use application\lib\Logger;

try {
    if (!file_exists('vendor/autoload.php')) {
        throw new Exception("File vendor/autoload.php was not found in project folder!");
    }
    require_once 'vendor/autoload.php';
} catch (Exception $exception) {
    Logger::createLog('error', $exception->getMessage());
    echo $exception->getMessage();
    die();
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router;
$router->run();
