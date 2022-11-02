<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class MainController extends Controller
{

    public function indexAction(int $param): void
    {
        $result = $this->model->getUsers($param);
        $usersArray = json_decode($result, true);
        if (!is_array($usersArray)) {
            $data = [
                'error' => 'API is incorrect! Check your .env file.'
            ];
            $this->view->render('Главная страница', $data);
            return;
        }

        $maxpage = intval(Pagination::getAmountOfPages());
        $data = [
            'genders' => self::GENDERS,
            'statuses' => self::STATUSES,
            'users' => $usersArray,
            'page' => $param,
            'maxpage' => $maxpage
        ];

        $this->view->render('Главная страница', $data);
    }
}