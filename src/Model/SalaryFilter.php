<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 10.8.18.
 * Time: 16.06
 */

namespace App\Model;


class SalaryFilter
{
    protected $dateFrom;
    protected $dateTo;

    /**
     * @return mixed
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * @param mixed $dateFrom
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
    }

    /**
     * @return mixed
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * @param mixed $dateTo
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;
    }


}