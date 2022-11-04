<?php

namespace application\lib;

use PDO;

class Db
{
    public PDO $PDO;

    public function __construct()
    {
        $this->PDO = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->PDO->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function oneValue($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetch(PDO::FETCH_COLUMN);
    }
}
