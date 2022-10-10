<?php

namespace application\models;

use application\core\Model;

class User extends Model
{
    public function createNewUser($email, $name, $gender, $status) {
        $result = $this->db->query("INSERT INTO users(email, name, gender, status) VALUES ('$email', '$name', '$gender', '$status')");
        return $result;
    }

    public function updateUserByEmail($email, $name, $gender, $status, $emailOld) {
        $result = $this->db->query("UPDATE users SET email='$email', name='$name', gender='$gender', status='$status' WHERE email='$emailOld';");
        return $result;
    }

    public function getUserByEmail($email) {
        $result = $this->db->row("SELECT * FROM users WHERE email='$email';");
        return $result;
    }

    public function deleteUserByEmail($email) {
        $result = $this->db->query("DELETE FROM users WHERE email='$email';");
        return $result;
    }
}