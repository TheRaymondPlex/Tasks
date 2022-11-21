<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\FileChecker;
use application\lib\Logger;

class FilesController extends Controller
{
    public function indexAction(): void
    {
        if (!$_SESSION['loggedIn']) {
            $this->view->redirect('/');
        }
        $uploadsDirPath = FileChecker::UPLOADS_FOLDER_PATH;
        if (!file_exists($uploadsDirPath)) {
            $this->view->render();
        } else {
            $uploads = $this->model->getUploads();
            $filesData = FileChecker::getMetaData($uploads);

            $data = [
                'uploads' => $filesData
            ];
            $this->view->render($data);
        }
    }

    public function uploadAction(): bool
    {
        if (!$_SESSION['loggedIn']) {
            $this->view->redirect('/');
        }
        if (!empty($_FILES)) {
            Logger::createLog('upload', "New upload attempt from " . $_SESSION['name']);

            $uploadsDirPath = FileChecker::UPLOADS_FOLDER_PATH;
            if (!file_exists($uploadsDirPath)) {
                Logger::createLog('upload', $uploadsDirPath . " folder does not exist. Creating...");
                try {
                    if (!mkdir($uploadsDirPath, 0777, true)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $uploadsDirPath));
                    }
                    Logger::createLog('upload', $uploadsDirPath . " created.");
                } catch (\RuntimeException $exception) {
                    Logger::createLog('error', $exception->getMessage());
                    echo $exception->getMessage() . "<br>";
                    return false;
                }
            }

            $errors = FileChecker::validatingFilesOnUpload();
            $data = [
                'errors' => $errors
            ];
            if (!empty($errors)) {
                $this->view->render($data);
                Logger::createLog('upload', "Upload attempt failed: $errors");
                return false;
            }

            $this->model->uploadFile($uploadsDirPath);
            $this->view->redirect('/file');
        }
        $this->view->render();

        return true;
    }

    public function downloadAction(): void
    {
        if (!$_SESSION['loggedIn']) {
            $this->view->redirect('/');
        }
        if (isset($_GET['file']) && file_exists(FileChecker::UPLOADS_FOLDER_PATH . $_GET['file'])) {
            $this->model->downloadFileByName($_GET['file']);
        }
        $this->view->redirect('/file');
    }

    public function deleteAction(): void
    {
        if (!$_SESSION['loggedIn']) {
            $this->view->redirect('/');
        }
        if (isset($_GET['file']) && file_exists(FileChecker::UPLOADS_FOLDER_PATH . $_GET['file'])) {
            $this->model->deleteFileByName($_GET['file']);
        }
        $this->view->redirect('/file');
    }

    public function deleteAllAction(): void
    {
        if (!$_SESSION['loggedIn']) {
            $this->view->redirect('/');
        }
        if (file_exists(FileChecker::UPLOADS_FOLDER_PATH)) {
            $this->model->deleteAllFiles();
        }
        $this->view->redirect('/file');
    }
}