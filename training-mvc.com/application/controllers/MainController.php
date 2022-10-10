<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function indexAction() {
        $result = $this->model->getUsers();
        $vars = [
            'users' => $result
        ];
        $this->view->render('Главная страница', $vars);
    }
}