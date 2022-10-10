<?php

namespace application\controllers;

use application\core\Controller;

class UserController extends Controller
{
    public function createAction() {
        if (!empty($_POST)) {
            $this->model->createNewUser($_POST['email'],$_POST['name'],$_POST['selectGender'],$_POST['selectStatus']);
            $this->view->redirect('/');
        }
        $this->view->render('Создать пользователя');
    }

    public function editAction() {
        if(!empty($_GET)) {
            $result = $this->model->getUserByEmail($_GET['email']);
            $vars = [
                'user' => $result
            ];
        }
        if (!empty($_POST)) {
            $this->model->updateUserByEmail($_POST['email'],$_POST['name'],$_POST['selectGender'],$_POST['selectStatus'],$_POST['emailOld']);
            $this->view->redirect('/');
        }
        $this->view->render('Редактировать',$vars);
    }

    public function deleteAction() {
        if(!empty($_GET)) {
            $this->model->deleteUserByEmail($_GET['email']);
            $this->view->redirect('/');
        }
        $this->view->render('Удаление');
    }
}