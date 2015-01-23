<?php


namespace b2\sprocket\axiomus\api;


class Okey extends ApplicationInfo
{
    private $statusCode;
    private $statusName;
    private $price;
    private $okey;

    function getOkey()
    {
        return $this->okey;
    }

    function setOkey($okey)
    {
        $this->okey = $okey;
        return $this;
    }

    function getStatusCode()
    {
        return $this->statusCode;
    }

    function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    function getStatusName()
    {
        return $this->statusName;
    }

    function setStatusName($statusName)
    {
        $this->statusName = $statusName;
        return $this;
    }

    function getPrice()
    {
        return $this->price;
    }

    function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}