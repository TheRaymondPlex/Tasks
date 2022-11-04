<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\FormChecker;

class UserController extends Controller
{
    private function checkUserData(): string
    {
        $id = $this->model->getUserIdByEmail($_POST['email']);
        if (empty($id)) {
            return 'There is no such user!';
        }
        if (password_verify($_POST['pass'], $this->model->getUserPassById($id))) {
            return '';
        } else {

            return 'Incorrect password!';
        }
    }

    public function loginAction(): void
    {
        if (!empty($_POST)) {
            $errors = $this->checkUserData();
            if (empty($errors)) {
                $_SESSION['welcome'] = $this->model->getUserNameByEmail($_POST['email']);
                $this->view->redirect('/');
            } else {
                $data = [
                    'errors' => $errors,
                    'email' => $_POST['email']
                ];
                $this->view->render($data);

                return;
            }
        }
        var_dump($this->model->getUserIdByEmail('test.mail@gmail.coom'));
        $this->view->render();
    }

    public function registerAction(): void
    {
        if (!empty($_POST)) {
            $errors = FormChecker::checkErrorsInForm();
            if (empty($errors)) {
                $hashedPass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $dbErrors = $this->model->addNewUser($_POST['email'], $_POST['first-name'], $_POST['second-name'], $hashedPass);
                if (!empty($dbErrors)) {
                    $_SESSION['errors'] = $dbErrors;
                }
                $_SESSION['newUser'] = $_POST['first-name'];
                $this->view->redirect('/');
            } else {
                $data = [
                    'errors' => $errors,
                    'firstName' => $_POST['first-name'],
                    'secondName' => $_POST['second-name'],
                    'email' => $_POST['email'],
                ];
                $this->view->render($data);

                return;
            }
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