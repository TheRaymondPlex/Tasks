<?php

namespace application\models;

use application\core\Model;
use application\lib\Db;
use application\lib\Logger;
use PDOException;


class Main extends Model
{
    public function getBlockedIps(): array
    {
        return $this->db->column("SELECT ip FROM blocked_ips;");
    }

    public function getBlockDate(string $ip): string
    {
        return $this->db->oneValue("SELECT blocked_date
                                        FROM blocked_ips
                                        WHERE ip='$ip';");
    }

    public function removeBlockedIp(string $ip): string
    {
        $this->db->PDO->beginTransaction();
        try {
            $this->db->PDO
                ->query("DELETE FROM blocked_ips WHERE ip='$ip';");
            $this->db->PDO->commit();
            return '';
        } catch (PDOException $exception) {
            $this->db->PDO->rollBack();
            Logger::createLog('error', $exception->getMessage());

            return 'PDOException: ' . $exception->getMessage();
        }
    }
}