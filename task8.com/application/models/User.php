<?php

namespace application\models;

use application\core\Model;
use application\lib\Db;
use application\lib\Logger;
use PDOException;

class User extends Model
{
    private const RECORD_ALREADY_EXISTS_ERROR_CODE = 23000;

    public function addNewUser(string $email, string $firstName, string $secondName, string $pass)
    {
        $this->db->PDO->beginTransaction();
        try {
            $this->db->PDO
                ->query("INSERT INTO users (email, first_name, second_name, pass_word)
                                  VALUES ('$email', '$firstName', '$secondName', '$pass');");
            $this->db->PDO->commit();
            return '';
        } catch (PDOException $exception) {
            $this->db->PDO->rollBack();

            if ($exception->getCode() == self::RECORD_ALREADY_EXISTS_ERROR_CODE) {
                return 'Email ' . $email . ' already taken!';
            }
            Logger::createLog('error', $exception->getMessage());

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
            Logger::createLog('error', $exception->getMessage());

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
            Logger::createLog('error', $exception->getMessage());

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
            Logger::createLog('error', $exception->getMessage());

            return 'PDOException: ' . $exception->getMessage();
        }
    }

    public function updateUsersAccessTokenByEmail(string $email, string $accessToken): string
    {
        $this->db->PDO->beginTransaction();
        try {
            $this->db->PDO
                ->query("UPDATE users
                                SET access_token ='$accessToken'
                                WHERE email='$email';");
            $this->db->PDO->commit();
            return '';
        } catch (PDOException $exception) {
            $this->db->PDO->rollBack();
            Logger::createLog('error', $exception->getMessage());

            return 'PDOException: ' . $exception->getMessage();
        }
    }

    public function getUsersEmailByAccessToken(string $accessToken): string
    {
        try {
            $result = $this->db->oneValue("SELECT email
                                            FROM users
                                            WHERE access_token='$accessToken'");
            return $result;
        } catch (PDOException $exception) {
            Logger::createLog('error', $exception->getMessage());

            return 'PDOException: ' . $exception->getMessage();
        }
    }

    public function addNewAttacker(string $attackerIp): string
    {
        $this->db->PDO->beginTransaction();
        try {
            $this->db->PDO
                ->query("INSERT INTO auth_attacks (attacker_ip, failed_tries_count)
                                  VALUES ('$attackerIp', 1);");
            $this->db->PDO->commit();
            return '';
        } catch (PDOException $exception) {
            $this->db->PDO->rollBack();
            Logger::createLog('error', $exception->getMessage());

            return 'PDOException: ' . $exception->getMessage();
        }
    }

    public function getAttackerTriesByIp(string $attackerIp): string
    {
        return $this->db->oneValue("SELECT failed_tries_count
                                        FROM auth_attacks
                                        WHERE attacker_ip='$attackerIp';");
    }

    public function updateAttackerByIp(string $attackerIp): string
    {
        $this->db->PDO->beginTransaction();
        try {
            $this->db->PDO
                ->query("UPDATE auth_attacks
                                SET failed_tries_count = failed_tries_count + 1
                                WHERE attacker_ip = '$attackerIp';");
            $this->db->PDO->commit();
            return '';
        } catch (PDOException $exception) {
            $this->db->PDO->rollBack();
            Logger::createLog('error', $exception->getMessage());

            return 'PDOException: ' . $exception->getMessage();
        }
    }

    public function deleteAttackerByIp(string $attackerIp): string
    {
        $this->db->PDO->beginTransaction();
        try {
            $this->db->PDO
                ->query("DELETE FROM auth_attacks
                                WHERE attacker_ip = '$attackerIp';");
            $this->db->PDO->commit();
            return '';
        } catch (PDOException $exception) {
            $this->db->PDO->rollBack();
            Logger::createLog('error', $exception->getMessage());

            return 'PDOException: ' . $exception->getMessage();
        }
    }

    public function addNewBlockedIp(string $ip): string
    {
        $this->db->PDO->beginTransaction();
        try {
            $this->db->PDO
                ->query("INSERT INTO blocked_ips (ip)
                                  VALUES ('$ip');");
            $this->db->PDO->commit();
            return '';
        } catch (PDOException $exception) {
            $this->db->PDO->rollBack();
            Logger::createLog('error', $exception->getMessage());

            return 'PDOException: ' . $exception->getMessage();
        }
    }
}