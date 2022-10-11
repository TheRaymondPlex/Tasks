<?php

namespace application\controllers;

use application\core\Controller;

class UserController extends Controller
{
    public function dataModify($data): string
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function validation(): bool
    {
        $email = $this->dataModify($_POST['email']);
        $name = $this->dataModify($_POST['name']);
        $email_len = strlen($email);
        $name_len = strlen($name);

        if (empty($email) && empty($name)) {
            $_SESSION['error'] = 'Name and Email fields are empty!';
            return false;
        }

        if (empty($email)) {
            $_SESSION['error'] = 'Email field is empty!';
            return false;
        }

        if (empty($name)) {
            $_SESSION['error'] = 'Name field is empty!';
            return false;
        }

        if ($email_len > 50 || $name_len > 40) {
            $_SESSION['error'] = 'Incorrect data entered!';
            return false;
        }

        return true;
    }

    public function createAction()
    {
        if (!empty($_POST)) {
            if ($this->validation()) {
                $this->model->createNewUser($_POST['email'], $_POST['name'], $_POST['selectGender'], $_POST['selectStatus']);
                $this->view->redirect('/');
            }
        }
        $this->view->render('Создать пользователя');
    }

    public function editAction()
    {
        if (!empty($_GET)) {
            $result = $this->model->getUserByEmail($_GET['email']);
            $vars = [
                'user' => $result
            ];
            $this->view->render('Редактировать', $vars);
        }
        if (!empty($_POST)) {
            if ($this->validation()) {
                $this->model->updateUserByEmail($_POST['email'], $_POST['name'], $_POST['selectGender'], $_POST['selectStatus'], $_POST['emailOld']);
                $this->view->redirect('/');
            } else {
                $this->view->redirect('?email='.$_POST['emailOld']);
            }
        }
    }

    public function deleteAction()
    {
        if (!empty($_GET)) {
            $this->model->deleteUserByEmail($_GET['email']);
            $this->view->redirect('/');
        }
        $this->view->render('Удаление');
    }
}