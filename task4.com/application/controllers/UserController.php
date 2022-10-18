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

    private function errorsCheck()
    {
        $result = [];

        $email = $this->dataModify($_POST['email']);
        $name = $this->dataModify($_POST['name']);
        $gender = $this->dataModify($_POST['gender']);
        $status = $this->dataModify($_POST['status']);
        $email_len = strlen($email);
        $name_len = strlen($name);


        if (empty($name)) {
            $result[] = 'Name field is empty!';
        } elseif (!preg_match("#^[a-zA-Z-' ]*$#",$name)) {
            $result[] = 'Only letters and white space can be in Name field!';
        } elseif ($name_len < 3) {
            $result[] = 'Name is too short! At least 3 characters needed.';
        }

        if (empty($email)) {
            $result[] = 'Email field is empty!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result[] = "This Email is not allowed!";
        }

        if ($email_len > 50) {
            $result[] = 'Email is too long! Max 50 characters allowed.';
        }

        if ($name_len > 40) {
            $result[] = 'Name is too long! Max 40 characters allowed.';
        }

        if (empty($gender)) {
            $result[] = 'Gender is empty!';
        }

        if (empty($status)) {
            $result[] = 'Status is empty!';
        }

        if ($gender != 'male' && $gender != 'female') {
            $result[] = 'Incorrect data in gender selector!';
        }

        if ($status != 'active' && $status != 'inactive') {
            $result[] = 'Incorrect data in status selector!';
        }

        return $result;
    }

    public function createAction()
    {
        if (!empty($_POST)) {
            $errors = $this->errorsCheck();

            if (empty($errors)) {
                $this->model->createNewUser();
                $this->view->redirect('/');
            } else {
                $errorsList = '';
                foreach ($errors as $key => $error) {
                    $errorsList.= $key+1 . ') ' . $error . '<br>';
                }

                $data = [
                  'errors' => $errorsList
                ];

                $this->view->render('Создать пользователя', $data);
            }

        } else $this->view->render('Создать пользователя');
    }

    public function updateAction(): void
    {
        if (!empty($_POST)) {
            $errors = $this->errorsCheck();

            if (empty($errors)) {
                $this->model->updateUserById($_POST['id']);
                $this->view->redirect('/');
            } else {
                $errorsList = '';
                foreach ($errors as $key => $error) {
                    $errorsList.= $key+1 . ') ' . $error . '<br>';
                }
                $_SESSION['error'] = $errorsList;
                $this->view->redirect('edit/' . $_POST['id']);
            }
        }
    }

    public function editAction(int $param): void
    {
        if (!empty($param)) {

            $result = $this->model->getUserById($param);
            $decoded = json_decode($result, true);

            $data = [
                'user' => $decoded
            ];
            $this->view->render('Редактировать', $data);
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