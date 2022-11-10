<?php

namespace application\lib;

class AttacksLogger
{
    private const LOGS_FOLDER_PATH = 'application/logs/'; //Default folder for logs

    public static function createLog(string $log): void
    {
        $logFileName = '!attacks_' . date('d.m.Y') . '.txt';
        $pathToLogFile = self::LOGS_FOLDER_PATH . $logFileName;

        if (!file_exists(self::LOGS_FOLDER_PATH)) {
            try {
                if (!mkdir(self::LOGS_FOLDER_PATH, 0777, true)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', self::LOGS_FOLDER_PATH));
                }
            } catch (\RuntimeException $exception) {
                echo $exception->getMessage() . "<br>";
                return;
            }
        }

        if (!file_exists($pathToLogFile)) {
            file_put_contents($pathToLogFile, '');
        }

        $time = date('[d.m.Y][H:i:s]', time());
        $ip = '[' . $_SERVER['REMOTE_ADDR'] . ']';
        $contents = file_get_contents($pathToLogFile);
        $contents .= "$time from $ip - $log\r";

        file_put_contents($pathToLogFile, $contents);
    }
}