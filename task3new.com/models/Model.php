<?php

class Model
{
    protected $db = null;

    public function __construct()
    {
        $this->db = DB::connToDB();
    }

    public function createUser($name, $email, $gender, $status) {
        $sql = "INSERT INTO users ('email', 'name', 'gender', 'status') VALUES ($name, $email, $gender, $status);";
        mysqli_query($this->db, $sql);
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users ORDER BY status";
        $result = mysqli_query($this->db, $sql);

        return $result;
    }

    public function deleteUserByEmail($email) {

    }

    public function editUserByEmail($name, $email, $gender, $status) {

    }

    public function getUserByEmail($email) {

    }
}