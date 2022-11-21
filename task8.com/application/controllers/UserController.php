<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\FormChecker;
use application\lib\Logger;

class UserController extends Controller
{
    private function checkIp($ip)
    {
        $attackerTriesCount = $this->model->getAttackerTriesByIp($ip);
        if (empty($attackerTriesCount)) {
            $this->model->addNewAttacker($ip);

            Logger::createLog('attack', 'IP ' . $_SERVER['REMOTE_ADDR']
                . ' was added to attackers list. Incorrect sign in tries - 1');

            return;
        }
        if ($attackerTriesCount === '1') {
            $this->model->updateAttackerByIp($ip);

            Logger::createLog('attack', 'IP ' . $_SERVER['REMOTE_ADDR']
                . ' was updated in attackers list. Incorrect sign in tries - 2');

            return;
        }
        Logger::createLog('attack', 'IP ' . $_SERVER['REMOTE_ADDR']
            . ' has 3 incorrect sign in attempts. Blocking IP...');

        $this->model->deleteAttackerByIp($ip);

        Logger::createLog('attack', 'IP ' . $_SERVER['REMOTE_ADDR']
            . ' was deleted from attackers list.');

        $this->blockIp($ip);
    }

    private function blockIp(string $ip)
    {
        $this->model->addNewBlockedIp($ip);

        Logger::createLog('ban', 'IP ' . $_SERVER['REMOTE_ADDR'] . ' was banned.');

        $this->view->redirect('/');
    }

    private function checkUserDataFromPost(): string
    {
        $id = $this->model->getUserIdByEmail($_POST['email']);
        if (empty($id)) {
            Logger::createLog('attack', 'Incorrect sign in attempt from IP - ' . $_SERVER['REMOTE_ADDR']);

            $this->checkIp($_SERVER['REMOTE_ADDR']);

            Logger::createLog('attack', 'Incorrect email entered - ' . $_POST['email']);

            return 'There is no such user!';
        }
        if (!password_verify($_POST['pass'], $this->model->getUserPassById($id))) {
            Logger::createLog('attack', 'Incorrect sign in attempt from IP - ' . $_SERVER['REMOTE_ADDR']);

            $this->checkIp($_SERVER['REMOTE_ADDR']);

            Logger::createLog('attack', 'Incorrect password entered.');

            return 'Incorrect password!';
        }

        return '';
    }

    private function checkUserDataFromCookie(): string
    {
        $usersEmail = $this->model->getUsersEmailByAccessToken($_COOKIE['auth']);
        if (empty($usersEmail)) {
            Logger::createLog('attack', 'Incorrect sign in attempt with cookie from IP ' . $_SERVER['REMOTE_ADDR']);

            return 'Wrong or old cookie!';
        }
        $_POST['email'] = $usersEmail;

        return '';
    }

    private function generateRandomString($length = 25): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function loginAction(): void
    {
        if (isset($_SESSION['loggedIn'])) {
            $this->view->redirect('/');
        }
        if (!empty($_POST) || !empty($_COOKIE['auth'])) {
            if (!empty($_POST)) {
                $errors = $this->checkUserDataFromPost();
            } else {
                $errors = $this->checkUserDataFromCookie();
            }
            if (!empty($errors)) {
                $data = [
                    'errors' => $errors,
                    'email' => $_POST['email'] ?? ''
                ];
                $this->view->render($data);

                return;
            }
            if (isset($_POST['remember'])) {
                $accessToken = $this->generateRandomString();
                $this->model->updateUsersAccessTokenByEmail($_POST['email'], $accessToken);
                setcookie('auth', $accessToken, time() + (86400 * 7), "/");
            }
            $attackerTriesCount = $this->model->getAttackerTriesByIp($_SERVER['REMOTE_ADDR']);
            if (!empty($attackerTriesCount)) {
                $this->model->deleteAttackerByIp($_SERVER['REMOTE_ADDR']);
            }
            $_SESSION['loggedIn'] = true;
            $_SESSION['name'] = $this->model->getUserNameByEmail($_POST['email']);
            $this->view->redirect('/');

        }
        $this->view->render();
    }

    public function registerAction(): void
    {
        if (isset($_SESSION['loggedIn'])) {
            $this->view->redirect('/');
        }
        if (!empty($_POST)) {
            $errors = FormChecker::checkErrorsInForm();
            if (!empty($errors)) {
                $data = [
                    'errors' => $errors,
                    'firstName' => $_POST['first-name'],
                    'secondName' => $_POST['second-name'],
                    'email' => $_POST['email'],
                ];
                $this->view->render($data);

                return;
            }
            $hashedPass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $dbErrors = $this->model
                ->addNewUser($_POST['email'], $_POST['first-name'], $_POST['second-name'], $hashedPass);
            if (!empty($dbErrors)) {
                $_SESSION['dbError'] = $dbErrors;
            } else {
                $_SESSION['name'] = $_POST['first-name'];
                $_SESSION['loggedIn'] = true;
            }
            $this->view->redirect('/');
        }
        $this->view->render();
    }

    public function logoutAction(): void
    {
        if (!isset($_SESSION['loggedIn'])) {
            $this->view->redirect('/');
        }
        if (isset($_COOKIE['auth'])) {
            setcookie('auth', '', time() - 1, '/');
        }
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        $this->view->redirect('/');
    }
}