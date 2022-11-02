<?php

namespace application\models;

class User
{
    public function getUserName(string $postEmail): string {
        $users = require 'application/config/accounts.php';

        if (isset($users[$postEmail])) {
            return $users[$postEmail]['name'];
        }

        return '';
    }
}