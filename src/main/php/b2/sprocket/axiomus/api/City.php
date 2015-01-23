<?php


namespace b2\sprocket\axiomus\api;


class City
{
    protected $cityCode;
    protected $city;

    function getCityCode()
    {
        return $this->cityCode;
    }

    function setCityCode($cityCode)
    {
        $this->cityCode = $cityCode;
        return $this;
    }

    function getCity()
    {
        return $this->city;
    }

    function setCity($city)
    {
        $this->city = $city;
        return $this;
    }


}