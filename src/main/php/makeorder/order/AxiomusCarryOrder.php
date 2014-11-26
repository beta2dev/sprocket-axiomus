<?php

namespace b2\sprocket\axiomous\api;

class AxiomusCarryOrder extends AxiomusOrder
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