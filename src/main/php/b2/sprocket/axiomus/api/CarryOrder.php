<?php

namespace b2\sprocket\axiomus\api;

class CarryOrder extends Order
{
    protected $endDate;
    protected $office;

    function getEndDate()
    {
        return $this->endDate;
    }
    function setEndDate($date)
    {
        $this->endDate = $date;
        return $this;
    }

    function getOffice()
    {
        return $this->office;
    }
    function setOffice($office)
    {
        $this->office = $office;
        return $this;
    }

}