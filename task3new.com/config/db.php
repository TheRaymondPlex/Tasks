<?php

//Класс конфигурации базы данных
class DB
{
    const USER = "root";
    const PASS = "1111";
    const HOST = "localhost";
    const DB   = "task3base";

    public static function connToDB()
    {
        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db   = self::DB;

        $conn = mysqli_connect($host, $user, $pass, $db);

        return $conn;
    }
}