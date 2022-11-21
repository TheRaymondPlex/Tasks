<?php

namespace application\lib;

class Logger
{
    private const LOGS_FOLDER_PATH = 'application/logs/'; //Default folder for logs
    private const LOG_TYPES = [
        'upl' => 'upload',
        'act' => 'action',
        'att' => 'attack',
        'ban' => 'ban',
        'err' => 'error'
    ];

    public static function createLog($logType, $log)
    {
        $pathToLogFile = '';
        if ($logType === self::LOG_TYPES['upl']) {
            $logFileName = 'uploads_' . date('d.m.Y') . '.txt';
            $pathToLogFile = self::LOGS_FOLDER_PATH . $logFileName;
        }
        if ($logType === self::LOG_TYPES['act']) {
            $logFileName = 'actions_' . date('d.m.Y') . '.txt';
            $pathToLogFile = self::LOGS_FOLDER_PATH . $logFileName;
        }
        if ($logType === self::LOG_TYPES['att']) {
            $logFileName = 'attacks_' . date('d.m.Y') . '.txt';
            $pathToLogFile = self::LOGS_FOLDER_PATH . $logFileName;
        }
        if ($logType === self::LOG_TYPES['ban']) {
            $logFileName = 'bans_' . date('d.m.Y') . '.txt';
            $pathToLogFile = self::LOGS_FOLDER_PATH . $logFileName;
        }
        if ($logType === self::LOG_TYPES['err']) {
            $logFileName = 'errors_' . date('d.m.Y') . '.txt';
            $pathToLogFile = self::LOGS_FOLDER_PATH . $logFileName;
        }

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