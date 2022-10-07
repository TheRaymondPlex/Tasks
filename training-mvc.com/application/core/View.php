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
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title, $vars = []) {
        $path = 'application/views/'.$this->path.'.php';
        $layout_path = 'application/views/layouts/'.$this->layout.'.php';

        extract($vars);
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require $layout_path;
        }
    }

    public function redirect($url) {
        header('Location: ' . $url);
        exit;
    }

    public static function errorCode($code) {
        http_response_code($code);

        $path_error = 'application/views/errors/'.$code.'.php';

        if (file_exists($path_error)) {
            require $path_error;
        }
        exit;
    }
}