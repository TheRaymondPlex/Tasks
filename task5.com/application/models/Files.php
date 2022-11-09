<?php

namespace application\models;

use application\lib\FileChecker;

class Files extends Main
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
        FileChecker::createLog('upload', "File " . $_FILES['filename']['name'] . ' will be renamed to ' . date('dmY-His-') . $_FILES['filename']['name']);
        FileChecker::createLog('upload', "File size - " . $_FILES['filename']['size'] . ' bytes');
        move_uploaded_file($_FILES["filename"]["tmp_name"], $dirPath . date('dmY-His-') . $_FILES['filename']['name']);
        FileChecker::createLog('upload', "New file successfully uploaded!");
    }

    public function downloadFileByName($name): void
    {
        $this->setHeaders($name);
        flush();
        readfile(FileChecker::UPLOADS_FOLDER_PATH . $name);
        FileChecker::createLog('action', "File \"" . $name . "\" was downloaded");
    }

    public function deleteFileByName($name): void
    {
        unlink(FileChecker::UPLOADS_FOLDER_PATH . $name);
        FileChecker::createLog('action', "File \"" . $name . "\" was deleted");
    }

    public function deleteAllFiles(): void
    {
        FileChecker::createLog('action', "Deleting all files...");
        $uploadsFolderPath = FileChecker::UPLOADS_FOLDER_PATH;
        $filesInFolder = FileChecker::deleteDots($uploadsFolderPath);

        foreach ($filesInFolder as $file) {
            unlink($uploadsFolderPath . $file);
            FileChecker::createLog('action', "Deleting \"" . $file . "\"");
        }
        FileChecker::createLog('action', "DELETED!");
    }
}