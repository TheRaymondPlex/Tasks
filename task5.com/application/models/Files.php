<?php

namespace application\models;

use application\lib\FileChecker;

class Files extends Main
{
    public function getUploads(): array
    {
        $uploadedFiles = [];
        $uploadsFolderPath = FileChecker::UPLOADS_FOLDER_PATH;

        $filesInFolder = array_diff(scandir($uploadsFolderPath), array('..', '.')); // Избавляемся от точек в массиве с файлами
        $filesInFolder = array_values($filesInFolder); // реиндексация массива после удаления точек

        foreach ($filesInFolder as $file) {
            $uploadedFiles[] = $uploadsFolderPath . $file;
        }

        return $uploadedFiles;
    }

    public function uploadFile(string $dirPath): void
    {
        $ext = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
        $newFileName = date('d.m.Y - H:i:s') . '.' . $ext;
        FileChecker::createLog('upload', "File " . $_FILES['filename']['name'] . ' was renamed to ' . $newFileName);
        FileChecker::createLog('upload', "File size - " . $_FILES['filename']['size'] . ' bytes');
        move_uploaded_file($_FILES["filename"]["tmp_name"], $dirPath . $newFileName);
        FileChecker::createLog('upload', "File " . $newFileName . " successfully uploaded!");
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
        $filesInFolder = array_diff(scandir($uploadsFolderPath), array('..', '.')); // Избавляемся от точек в массиве с файлами
        $filesInFolder = array_values($filesInFolder); // реиндексация массива после удаления точек

        foreach ($filesInFolder as $file) {
            unlink($uploadsFolderPath . $file);
            FileChecker::createLog('action', "Deleting \"" . $file . "\"");
        }
        FileChecker::createLog('action', "DELETED!");
    }
}