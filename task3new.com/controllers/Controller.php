<?php

class Controller
{
    public $model;
    public $view;
    protected $pageData = array();

    public function __construct()
    {
        $this->model = new View();
        $this->view = new Model();
    }
}















//class Controller
//{
//    public $data;
//
//    public function __construct()
//    {
//        switch ($_GET['action']) {
//            case 'edit':
//                $this->data = Model::editUserByEmail();
//                break;
//            case 'add':
//                $this->data = Model::createUser();
//                break;
//            case 'delete':
//                $this->data = Model::deleteUserByEmail();
//                break;
//            default:
//                $this->data = Model::getAllUsers();
//                require_once "/home/user/PhpstormProjects/Task3/task3new.com/views/read.php";
//        }
//    }
//
//    public function render() {
//
//    }
//}