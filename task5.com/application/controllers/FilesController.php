<?php

namespace application\controllers;

use application\core\Controller;

class FilesController extends Controller
{
    public function uploadAction()
    {
        if (!empty($_FILES)) {
            $this->model->uploadFile();
        }
        $this->view->render();
    }

    public function deleteAction(int $param): void
    {
        $this->view->render();
    }
}