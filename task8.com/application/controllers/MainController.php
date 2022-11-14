<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    private const BLOCK_DURATION = 900; // seconds

    public function indexAction(): void
    {
        $blockedIps = $this->model->getBlockedIps();
        if (in_array($_SERVER['REMOTE_ADDR'], $blockedIps)) {
            $blockDate = strtotime($this->model->getBlockDate($_SERVER['REMOTE_ADDR']));
            $unblockDate = $blockDate + self::BLOCK_DURATION;
            $secondsLeft = round($unblockDate - time());

            if (time() < $unblockDate) {
                die('You was banned for 15 minutes! Time left: ' . date('i:s', $secondsLeft)) . '.';
            } else {
                $this->model->removeBlockedIp($_SERVER['REMOTE_ADDR']);
            }
        }
        if (isset($_SESSION['name'])) {
            $data = [
                'name' => $_SESSION['name']
            ];
            $this->view->render($data);
            return;
        }


        if (isset($_COOKIE['auth'])) {
            $this->view->redirect('/user/login');
        }

        if (isset($_SESSION['dbError'])) {
            $data = [
                'errors' => $_SESSION['dbError']
            ];
            $this->view->render($data);
            unset($_SESSION['dbError']);
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