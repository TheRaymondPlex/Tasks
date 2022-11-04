<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function indexAction(): void
    {
        if (isset($_SESSION['welcome'])) {
            $data = [
                'welcome' => $_SESSION['welcome']
            ];
            $this->view->render($data);
            return;
        }
        if (isset($_SESSION['errors'])) {
            $data = [
                'errors' => $_SESSION['errors']
            ];
            $this->view->render($data);
            unset($_SESSION['errors']);
            return;
        }
        if (isset($_SESSION['newUser'])) {
            $data = [
                'newUser' => $_SESSION['newUser']
            ];
            $this->view->render($data);
            unset($_SESSION['newUser']);

            return;
        }
        $this->view->render();
    }
}