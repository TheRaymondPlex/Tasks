<?php

namespace application\models;

use application\core\Model;

class User extends Model
{
    public function createNewUser(): int
    {
        $curl = curl_init(getenv('API') . '?access-token=' . getenv('ACCESS_TOKEN'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST);

        curl_exec($curl);
        $respCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return $respCode;
    }

    public function updateUserById(int $id): int
    {
        $curl = curl_init(getenv('API') . '/' . $id . '?access-token=' . getenv('ACCESS_TOKEN'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');

        curl_exec($curl);
        $respCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return $respCode;
    }

    public function getUserById(int $id)
    {
        $curl = curl_init(getenv('API') . '/' . $id . '?access-token=' . getenv('ACCESS_TOKEN'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function deleteUserById(int $id): void
    {
        $curl = curl_init(getenv('API') . '/' . $id . '?access-token=' . getenv('ACCESS_TOKEN'));

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');

        curl_exec($curl);
        curl_close($curl);
    }
}