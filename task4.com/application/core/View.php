<?php

namespace application\core;

class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render(string $title, $data = []): void
    {
        $path = 'application/views/' . $this->path . '.php';
        $layout_path = 'application/views/layouts/' . $this->layout . '.php';

//        extract($data);

        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require $layout_path;
        }
    }

    public function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    public static function showErrorPage(int $code): void
    {
        http_response_code($code);

        $path = 'application/views/errors/errorPage.php';
        $layout_path = 'application/views/layouts/default.php';
        $title = 'Ошибка ' . $code;

        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require $layout_path;
        }
        exit;
    }
}