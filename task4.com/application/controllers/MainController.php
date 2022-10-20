<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{

    public function indexAction(int $param): void
    {
        $result = $this->model->getUsers($param);
        $data = [
            'genders' => self::GENDERS,
            'statuses' => self::STATUSES,
            'users' => json_decode($result, true),
            'page' => $param
        ];

        $this->view->render('Главная страница', $data);
    }
}