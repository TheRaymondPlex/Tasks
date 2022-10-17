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

    public function nameEmailValidation(): bool
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

        if (!preg_match("#^[a-zA-Z-' ]*$#",$name)) {
            $_SESSION['error'] = "Only letters and white space can be in Name field!";
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "This email is not allowed!";
            return false;
        }

        if ($email_len > 50 || $name_len < 3 || $name_len > 40) {
            $_SESSION['error'] = 'Incorrect data entered!';
            return false;
        }

        return true;
    }

    public function selectFieldsValidation(): bool
    {
        $gender = $this->dataModify($_POST['gender']);
        $status = $this->dataModify($_POST['status']);

        if (empty($gender) && empty($status)) {
            $_SESSION['error'] = 'Incorrect data!';
            return false;
        }

        if ($gender != 'male' && $gender != 'female') {
            $_SESSION['error'] = 'Incorrect gender!';
            return false;
        }

        if ($status != 'active' && $status != 'inactive') {
            $_SESSION['error'] = 'Incorrect status!';
            return false;
        }

        return true;
    }

    public function createAction()
    {
        if (!empty($_POST)) {
            if ($this->nameEmailValidation() && $this->selectFieldsValidation()) {
//                $this->model->createNewUser($_POST['email'], $_POST['name'], $_POST['selectGender'], $_POST['selectStatus']);
                $this->model->createNewUser();
                $this->view->redirect('/');
            }
        }
        $this->view->render('Создать пользователя');
    }

    public function editAction(int $param): void {
        if (!empty($param)) {
            $result = $this->model->getUserById($param);
            $decoded = json_decode($result, true);

            $data = [
                'user' => $decoded
            ];
            $this->view->render('Редактировать', $data);
        }
    }

    public function updateAction(): void
    {
        if (!empty($_POST)) {
            if ($this->nameEmailValidation() && $this->selectFieldsValidation()) {
                $this->model->updateUserById($_POST['id']);
                $this->view->redirect('/');
            } else {
                $this->view->redirect('edit/'.$_POST['id']);
            }
        }
    }

    public function deleteAction(int $param): void
    {
        if (!empty($param)) {
            $this->model->deleteUserById($param);
            $this->view->redirect('/');
        }
        $this->view->render('Удаление');
    }
}