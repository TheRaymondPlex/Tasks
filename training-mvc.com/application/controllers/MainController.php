<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function indexAction() {
        $vars = [
            'name' => 'Vasya',
            'age' => 88,
        ];
        $this->view->render('Главная страница', $vars);
    }
}