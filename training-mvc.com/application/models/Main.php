<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function getUsers() {
        $result = $this->db->row('SELECT * FROM users ORDER BY addDate DESC;');
        return $result;
    }
}