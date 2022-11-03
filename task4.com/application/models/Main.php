<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function getUsers(int $page)
    {
        $curl = curl_init(getenv('API') . '?page=' . $page . '&access-token=' . getenv('ACCESS_TOKEN'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }
}