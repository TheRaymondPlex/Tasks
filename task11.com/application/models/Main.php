<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function getAverageAllTime(): string
    {
        $result = $this->db->oneValue('
                            select round(avg(price)) as avr_all_time
                            from showroom_cars
                            where sold_status = 1;
        ');
        if (empty($result)) {
            return '';
        }
        return $result;
    }

    public function getAverageToday(): string
    {
        $result = $this->db->oneValue('
                            select round(avg(price)) as avr_today
                            from showroom_cars
                            where sold_status = 1 and date_of_sale = curdate();
        ');
        if (empty($result)) {
            return '';
        }
        return $result;
    }

    public function getLastYearSales(): array
    {
        return $this->db->row('
                            select date_of_sale, count(date_of_sale) as sales_on_day
                            from showroom_cars
                            where date_of_sale < \'2022-01-01\'
                            group by date_of_sale;
        ');
    }

    public function getUnsold()
    {
        return $this->db->row('
                            select dir.model, dir.year_of_production as year, sh.color, sh.price
                            from vehicle_directory as dir, showroom_cars as sh
                            where dir.id = sh.vehicle_id and sh.sold_status = 2
                            order by year desc, price;
        ');
    }

    public function getOnSale()
    {
        return $this->db->row('
                            select dir.model
                            from vehicle_directory as dir, showroom_cars as sh
                            where dir.id = sh.vehicle_id and sh.sold_status = 2
                            order by model;
        ');
    }
}