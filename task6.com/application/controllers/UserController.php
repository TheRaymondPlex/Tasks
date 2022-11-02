<?php

namespace application\controllers;

use application\core\Controller;

class UserController extends Controller
{
    private function checkUserData(): bool {
        $users = require_once 'application/config/accounts.php';

        if (isset($users[$_POST['email']])) {
            if (password_verify($_POST['pass'], $users[$_POST['email']]['password'])) {
                return true;
            } else {
                $_SESSION['error'] .= "Incorrect password!\n";
                return false;
            }
        }

        return false;
    }

    public function loginAction(): void
    {
        if (!empty($_POST)) {
            $result = $this->checkUserData();
            if ($result) {
                $_SESSION['welcome'] = $this->model->getUserName($_POST['email']);
            } else {
                $_SESSION['error'] .= "Incorrect data entered!\n";
            }
            $this->view->redirect('/');
        }
        $this->view->render();
    }


    public function logoutAction(): void
    {
        if (isset($_SESSION['welcome'])) {
            unset($_SESSION['welcome']);
        }
        $this->view->redirect('/');
    }
}