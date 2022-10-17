<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function indexAction(int $param): void
    {
        $result = $this->model->getUsers($param);
        $decoded = json_decode($result, true);

        $data = [
            'users' => $decoded,
            'page' => $param
        ];

        $this->view->render('Главная страница', $data);
    }
}