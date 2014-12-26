<?php


namespace b2\sprocket\axiomous\adapter;


class ContentResponse{

    protected $carryList;
    protected $pickupList;
    protected $courier;
    protected $region;

    function getCarryList()
    {
        return $this->carryList;
    }

    function setCarryList($carryList)
    {
        $this->carryList = $carryList;
        return $this;
    }

    function getPickupList()
    {
        return $this->pickupList;
    }

    function setPickupList($pickupList)
    {
        $this->pickupList = $pickupList;
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

    function getRegion()
    {
        return $this->region;
    }

    function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

}