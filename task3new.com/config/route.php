<?php

/*
 * Класс маршрутизации
 *
 * domain/index.php
 * domain/index.php?action=add
 * domain/index.php?action=edit&item=2
 * domain/index.php?action=delete&item=2
 */

class Routing
{
    public static function buildRoute() {

        //Контроллер и action по умолчанию
        $controllerName = "IndexController";
        $modelName = "IndexModel";
        $action = "index";

        //pars_url()

        $route = explode("/", $_SERVER['REQUEST_URI']);
        $control = $route[1];

        if (isset($route[2]) && $route[2] != '') {
            $action = $route[2];
        }

        //Определяем контроллер
        if ($control != '') {
            $controllerName = ucfirst($route[1] . "Controller");
            $modelName = ucfirst($route[1] . "Model");
        }

        require_once CONTROLLER_PATH . $controllerName . ".php"; //IndexController.php
        require_once MODEL_PATH . $modelName . ".php"; //IndexModel.php

        $controller = new $controllerName();
        $controller->$action();
    }

    public function errorPage() {

    }
}