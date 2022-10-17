<?php

namespace application\models;

use application\core\Model;

class User extends Model
{
    public function createNewUser(): void
    {
        $curl = curl_init(getenv('API').'?access-token='.getenv('ACCESS_TOKEN'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST);

        curl_exec($curl);
        curl_close($curl);

    }

    public function updateUserById($id)
    {
        $curl = curl_init(getenv('API') . '/' . $id . '?access-token=' . getenv('ACCESS_TOKEN'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');

        curl_exec($curl);
        curl_close($curl);
    }

    public function getUserById($id)
    {
        $curl = curl_init(getenv('API') . '/' . $id . '?access-token=' . getenv('ACCESS_TOKEN'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function deleteUserById($id): void
    {
        $curl = curl_init(getenv('API').'/'.$id.'?access-token='.getenv('ACCESS_TOKEN'));

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');

        curl_exec($curl);
        curl_close($curl);
    }
}