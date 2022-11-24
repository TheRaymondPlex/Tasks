<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{

    public function indexAction(): void
    {
        $avrAllTime = $this->model->getAverageAllTime();
        $avrToday = $this->model->getAverageToday();
        $lastYear = $this->model->getLastYearSales();
        $unsold = $this->model->getUnsold();
        $onSale = $this->model->getOnSale();

        $data = [
            'avrAllTime' => $avrAllTime,
            'avrToday' => $avrToday,
            'lastYear' => $lastYear,
            'unsold' => $unsold,
            'onSale' => $onSale
        ];
        $this->view->render($data);
    }
}