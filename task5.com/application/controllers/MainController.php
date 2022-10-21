<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function indexAction(): void
    {
        $result = $this->model->getUploads();

        $data = [
            'uploads' => $result,
        ];

        $this->view->render($data);
    }
}