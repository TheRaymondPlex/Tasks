<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function getAverageAllTime(): string
    {
        $result = $this->db->oneValue("
            SELECT ROUND(AVG(price)) AS avr_all_time
            FROM showroom_cars AS sc
            LEFT JOIN statuses s ON sc.sold_status = s.id
            WHERE s.name = 'Sold';
        ");
        if (empty($result)) {
            return "";
        }
        return $result;
    }

    public function getAverageToday(): string
    {
        $result = $this->db->oneValue("
            SELECT ROUND(AVG(price)) AS avr_today
            FROM showroom_cars AS sc
            LEFT JOIN statuses s ON s.id = sc.sold_status
            WHERE s.name = 'Sold' and date_of_sale = CURDATE();
        ");
        if (empty($result)) {
            return "";
        }
        return $result;
    }

    public function getLastYearSales(): array
    {
        return $this->db->row("
            SELECT date_of_sale, count(date_of_sale) AS sales_on_day
            FROM showroom_cars
            WHERE date_of_sale < CONCAT(YEAR(CURDATE()),'-01-01')
            GROUP BY date_of_sale;
        ");
    }

    public function getUnsold()
    {
        return $this->db->row("
            SELECT model, year_of_production AS year, color, price
            FROM vehicle_directory AS vd
                LEFT JOIN showroom_cars sc ON vd.id = sc.vehicle_id
                LEFT JOIN statuses s ON sc.sold_status = s.id
            WHERE s.name = 'Not Sold'
            ORDER BY year DESC, price;
        ");
    }

    public function getOnSale()
    {
        return $this->db->row("
            SELECT dir.model
            FROM vehicle_directory AS dir
                LEFT JOIN showroom_cars AS sc ON dir.id = sc.vehicle_id
                LEFT JOIN statuses s ON s.id = sc.sold_status
            WHERE s.name = 'Not Sold'
            ORDER BY model;
        ");
    }
}