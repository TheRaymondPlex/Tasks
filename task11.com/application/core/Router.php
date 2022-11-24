<?php

namespace application\core;

use application\core\View;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $arr = require 'application/config/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    private function add(string $route, array $params): void {
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $params;
    }

    private function getUrl(): string {
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (!empty($urlPath)) {
            return trim($urlPath, '/');
        }

        return '';
    }

    private function isUrlValid():bool {
        $url = $this->getUrl();

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $mathes)) {
                $this->params = $params;
                if (empty($url)) {
                    return true;
                }
                $this->moveParams();
                return true;
            }
        }

        return false;
    }

    private function moveParams(): void {
        if (array_key_exists('param', $this->params)) {
            $this->params['param'] = $this->getParams();
        }
    }

    private function getParams(): string {
        $url = $this->getUrl();
        $segments = explode('/', $url);
        return end($segments);
    }

    public function run(): void {
        if (!$this->isUrlValid()) {
            View::showErrorPage(404);
        }
        $path = 'application\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
        $action = $this->params['action'] . 'Action';
        $controller = new $path($this->params);
        if (array_key_exists('param', $this->params) ) {
            $controller->$action($this->params['param']);
        } else {
            $controller->$action();
        }
    }
}