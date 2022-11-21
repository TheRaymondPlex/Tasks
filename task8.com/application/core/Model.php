<?php

namespace application\core;

use application\lib\Db;
use application\lib\FileChecker;

abstract class Model
{
    public $db;

    public function __construct()
    {
        $this->db = new Db;
    }

    public function setHeaders($name): void
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="' . ('downloaded_from_task5.com_' . $name) . '"');
        header('Content-Length: ' . filesize(FileChecker::UPLOADS_FOLDER_PATH . $name));
        header('Pragma: public');
    }
}