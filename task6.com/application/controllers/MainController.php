<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function indexAction(): void
    {
        if (isset($_SESSION['welcome'])) {
            $data = [
                'name' => $_SESSION['welcome']
            ];
            $this->view->render($data);
        }
        if (isset($_SESSION['error'])) {
            $data = [
                'errors' => $_SESSION['error']
            ];
            $this->view->render($data);
            unset($_SESSION['error']);
        }
        $this->view->render();
    }
}