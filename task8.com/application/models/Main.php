<?php

namespace application\models;

use application\core\Model;
use application\lib\Db;

class Main extends Model
{
    public function getBlockedIps(): array
    {
        return $this->db->column("SELECT ip FROM blocked_ips;");
    }
}