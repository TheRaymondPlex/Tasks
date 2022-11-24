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

    public function render($data = []): void
    {
        $loader = new FilesystemLoader('application/views/');
        $twig = new Environment($loader);

        echo $twig->render($this->path . '.twig', $data);
    }

    public function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    public static function showErrorPage($code): void
    {
        http_response_code($code);
        $path = '/errors/errorPage';

        $loader = new FilesystemLoader('application/views/');
        $twig = new Environment($loader);

        $data = [
          'code' => $code
        ];

        echo $twig->render($path . '.twig', $data);

        exit();
    }
}