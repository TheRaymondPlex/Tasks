<?php

namespace application\models;

use application\lib\FileChecker;
use application\lib\Logger;
use application\core\Model;

class Files extends Model
{
    public function getUploads(): array
    {
        $uploadedFiles = array();
        $uploadsFolderPath = FileChecker::UPLOADS_FOLDER_PATH;

        $filesInFolder = FileChecker::deleteDots($uploadsFolderPath);

        foreach ($filesInFolder as $file) {
            $uploadedFiles[] = $uploadsFolderPath . $file;
        }

        return $uploadedFiles;
    }

    public function uploadFile(string $dirPath): void
    {
        Logger::createLog('upload', "File " . $_FILES['filename']['name'] . ' will be renamed to ' . date('dmY-His-') . $_FILES['filename']['name']);
        Logger::createLog('upload', "File size - " . $_FILES['filename']['size'] . ' bytes');
        move_uploaded_file($_FILES["filename"]["tmp_name"], $dirPath . date('dmY-His-') . $_FILES['filename']['name']);
        Logger::createLog('upload', $_SESSION['name'] . " successfully uploaded new file!");
    }

    public function downloadFileByName($name): void
    {
        $this->setHeaders($name);
        flush();
        readfile(FileChecker::UPLOADS_FOLDER_PATH . $name);
        Logger::createLog('action', "File \"" . $name . "\" was downloaded by " . $_SESSION['name']);
    }

    public function deleteFileByName($name): void
    {
        unlink(FileChecker::UPLOADS_FOLDER_PATH . $name);
        Logger::createLog('action', "File \"" . $name . "\" was deleted by " . $_SESSION['name']);
    }

    public function deleteAllFiles(): void
    {
        Logger::createLog('action', "All files removing was initiated by " . $_SESSION['name']);
        $uploadsFolderPath = FileChecker::UPLOADS_FOLDER_PATH;
        $filesInFolder = FileChecker::deleteDots($uploadsFolderPath);

        foreach ($filesInFolder as $file) {
            unlink($uploadsFolderPath . $file);
            Logger::createLog('action', "Deleting \"" . $file . "\"");
        }
        Logger::createLog('action', "DELETED!");
    }
}