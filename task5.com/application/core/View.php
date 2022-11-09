<?php

namespace application\core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    public $path;
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];

    }

    public function render($data = [])
    {
        $loader = new FilesystemLoader('application/views/');
        $twig = new Environment($loader);

        echo $twig->render($this->path . '.twig', $data);
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }

    public static function showErrorPage($code)
    {
        http_response_code($code);

        $path_error = 'application/views/errors/' . $code . '.php';

        if (file_exists($path_error)) {
            require $path_error;
        }
        exit;
    }
}