<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\FileChecker;

class FilesController extends Controller
{
    public function indexAction(): void
    {
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
        if (!empty($_FILES)) {
            FileChecker::createLog('upload', "New upload attempt!");

            $uploadsDirPath = FileChecker::UPLOADS_FOLDER_PATH;
            if (!file_exists($uploadsDirPath)) {
                FileChecker::createLog('upload', $uploadsDirPath . " folder does not exist. Creating...");
                try {
                    if (!mkdir($uploadsDirPath, 0777, true)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $uploadsDirPath));
                    }
                    FileChecker::createLog('upload', $uploadsDirPath . " created.");
                } catch (\RuntimeException $exception) {
                    FileChecker::createLog('upload', $exception->getMessage());
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
                FileChecker::createLog('upload', "Upload attempt failed: $errors");
                return false;
            }

            $this->model->uploadFile($uploadsDirPath);
            $this->view->redirect('/');
        }
        $this->view->render();

        return true;
    }

    public function downloadAction(): void
    {
        if (isset($_GET['file']) && file_exists(FileChecker::UPLOADS_FOLDER_PATH . $_GET['file'])) {
            $this->model->downloadFileByName($_GET['file']);
        }
        $this->view->redirect('/');
    }

    public function deleteAction(): void
    {
        if (isset($_GET['file']) && file_exists(FileChecker::UPLOADS_FOLDER_PATH . $_GET['file'])) {
            $this->model->deleteFileByName($_GET['file']);
        }
        $this->view->redirect('/');
    }

    public function deleteAllAction(): void
    {
        if (file_exists(FileChecker::UPLOADS_FOLDER_PATH)) {
            $this->model->deleteAllFiles();
        }
        $this->view->redirect('/');
    }
}