<?php

namespace application\core;

use application\core\View;

abstract class Controller
{
    protected $route;
    protected $view;
    protected $model;

    protected const GENDERS = [
        'male' => 'Мужчина',
        'female' => 'Женщина'
    ];
    protected const STATUSES = [
        'active' => 'Активный',
        'inactive' => 'Неактивный'
    ];


    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel(string $modelName)
    {
        $path = 'application\models\\' . ucfirst($modelName);
        if (class_exists($path)) {
            return new $path;
        }

        return null;
    }
}