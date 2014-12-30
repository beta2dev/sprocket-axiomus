<?php


namespace b2\sprocket\axiomus\adapter;


class Region {
    private $regionCode;
    private $name;
    private $courier;
    private $pickup;

    function getPickup()
    {
        return $this->pickup;
    }

    function setPickup($pickup)
    {
        $this->pickup = $pickup;
        return $this;
    }

    function getCourier()
    {
        return $this->courier;
    }

    function setCourier($courier)
    {
        $this->courier = $courier;
        return $this;
    }

    function getRegionCode()
    {
        return $this->regionCode;
    }

    function setRegionCode($regionCode)
    {
        $this->regionCode = $regionCode;
        return $this;
    }

    function getName()
    {
        return $this->name;
    }

    function setName($regionName)
    {
        $this->name = $regionName;
        return $this;
    }


}