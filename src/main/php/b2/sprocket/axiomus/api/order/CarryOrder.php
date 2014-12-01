<?php

namespace b2\sprocket\axiomous\api\order;

class CarryOrder extends Order
{
    protected $beginDate;
    protected $endDate;
    protected $office;

    function getBeginDate()
    {
        return $this->beginDate;
    }
    function setBeginDate($date)
    {
        $this->beginDate = $date;
        return $this;
    }

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