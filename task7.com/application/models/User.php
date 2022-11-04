<?php

namespace application\models;

use application\core\Model;
use application\lib\Db;
use PDOException;

class User extends Model
{
    public function addNewUser(string $email, string $firstName, string $secondName, string $pass): string
    {
        try {
            $this->db->PDO->beginTransaction();
            $this->db->PDO
                ->query("INSERT INTO users (email, first_name, second_name, pass_word, created_date)
                                  VALUES ('$email', '$firstName', '$secondName', '$pass', now());");
            $this->db->PDO->commit();
            return '';
        } catch (PDOException $exception) {
            $this->db->PDO->rollBack();

            return 'PDOException: ' . $exception->getMessage();
        }
    }

    public function getUserIdByEmail(string $email): string
    {
        try {
            $result = $this->db->oneValue("SELECT id
                                        FROM users
                                        WHERE email='$email'");
            return $result;
        } catch (PDOException $exception) {

            return 'PDOException: ' . $exception->getMessage();
        }
    }

    public function getUserNameByEmail(string $email): string
    {
        try {
            $result = $this->db->oneValue("SELECT first_name
                                        FROM users
                                        WHERE email='$email'");
            return $result;
        } catch (PDOException $exception) {

            return 'PDOException: ' . $exception->getMessage();
        }
    }

    public function getUserPassById(string $id): string
    {
        try {
            $result = $this->db->oneValue("SELECT pass_word
                                        FROM users
                                        WHERE id='$id'");
            return $result;
        } catch (PDOException $exception) {

            return 'PDOException: ' . $exception->getMessage();
        }
    }
}