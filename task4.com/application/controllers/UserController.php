<?php

namespace application\controllers;

use application\core\Controller;
use application\core\View;

class UserController extends Controller
{

    private function modifyFormData(string $data): string
    {
        $data = trim($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    private function validateUserData(): array
    {
        $errors = [];

        $email = $this->modifyFormData($_POST['email']);
        $name = $this->modifyFormData($_POST['name']);
        $gender = $this->modifyFormData($_POST['gender']);
        $status = $this->modifyFormData($_POST['status']);


        if (empty($name)) {
            $errors[] = 'Name field is empty!';
        } elseif (!preg_match("#^[a-zA-Z-' ]*$#", $name)) {
            $errors[] = 'Only letters and white space can be in Name field!';
        } elseif (strlen($name) < 3) {
            $errors[] = 'Name is too short! At least 3 characters needed.';
        }

        if (empty($email)) {
            $errors[] = 'Email field is empty!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "This Email is not allowed!";
        }

        if (strlen($email) > 50) {
            $errors[] = 'Email is too long! Max 50 characters allowed.';
        }

        if (strlen($name) > 40) {
            $errors[] = 'Name is too long! Max 40 characters allowed.';
        }

        if (empty($gender)) {
            $errors[] = 'Gender is empty!';
        }

        if (empty($status)) {
            $errors[] = 'Status is empty!';
        }

        if (!in_array($gender, self::GENDERS)) {
            $errors[] = 'Incorrect data in gender selector!';
        }

        if (!in_array($status, self::STATUSES)) {
            $errors[] = 'Incorrect data in status selector!';
        }

        return $errors;
    }

    private function convertErrorsToList(array $errors): string
    {
        $errorsList = '';
        foreach ($errors as $key => $error) {
            $errorsList .= $key + 1 . ') ' . $error . '<br>';
        }

        return $errorsList;
    }

    private function checkResponseStatus(int $code): bool
    {
        if ($code == 422) { // Статус 422 приходит от API, когда ему отправлены недействительные данные
            return false;
        }
        return true;
    }

    private function redirectToPages(int $response): void
    {
        if (!$this->checkResponseStatus($response)) {
            View::showErrorPage($response);
        } else {
            $this->view->redirect('/');
        }
    }

    public function createAction(): void
    {
        if (empty($_POST)) {
            $data = [
                'genders' => self::GENDERS,
                'statuses' => self::STATUSES
            ];
            $this->view->render('Создать пользователя', $data);
            return;
        }

        $errors = $this->validateUserData();
        if (empty($errors)) {
            $response = $this->model->createNewUser();
            $this->redirectToPages($response);
        } else {
            $data = [
                'genders' => self::GENDERS,
                'statuses' => self::STATUSES,
                'errors' => $this->convertErrorsToList($errors)
            ];
            $this->view->render('Создать пользователя', $data);
        }
    }

    public function updateAction(): void
    {
        if (!empty($_POST)) {
            $errors = $this->validateUserData();

            if (empty($errors)) {
                $response = $this->model->updateUserById($_POST['id']);
                $this->redirectToPages($response);
            } else {
                $_SESSION['error'] = $this->convertErrorsToList($errors);
                $this->view->redirect('edit/' . $_POST['id']);
            }
        }
    }

    public function editAction(int $param): void
    {
        if (!empty($param)) {

            $result = $this->model->getUserById($param);

            $data = [
                'user' => json_decode($result, true),
                'genders' => self::GENDERS,
                'statuses' => self::STATUSES
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
    }
}