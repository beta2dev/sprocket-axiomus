<?php

namespace axi\makeorder\order;

class AxiomusCarryOrder extends AxiomusOrder
{
    protected $bDate;
    protected $eDate;
    protected $office;

    function getBDate()
    {
        return $this->bDate;
    }
    function setBDate($date)
    {
        $this->bDate = $date;
        return $this;
    }

    function getEDate()
    {
        return $this->eDate;
    }
    function setEDate($date)
    {
        $this->eDate = $date;
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