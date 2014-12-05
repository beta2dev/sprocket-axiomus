<?php

namespace b2\sprocket\axiomous\api\order\desc\address;

class OrderAddress
{
    protected $index;
    protected $region;
    protected $area;
    protected $poluchAddress;
    protected $building;
    protected $apartment;
    protected $street;
    protected $house;
    protected $carrymode;

    function getCarrymode()
    {
        return $this->carrymode;
    }

    function setCarrymode($carrymode)
    {
        $this->carrymode = $carrymode;
        return $this;
    }

    function getStreet()
    {
        return $this->street;
    }

    function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    function getHouse()
    {
        return $this->house;
    }

    function setHouse($house)
    {
        $this->house = $house;
        return $this;
    }

    function getBuilding()
    {
        return $this->building;
    }

    function setBuilding($building)
    {
        $this->building = $building;
        return $this;
    }

    function getApartment()
    {
        return $this->apartment;
    }

    function setApartment($apartment)
    {
        $this->apartment = $apartment;
        return $this;
    }

    function getIndex()
    {
        return $this->index;
    }

    function setIndex($index)
    {
        $this->index = $index;
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

    function getArea()
    {
        return $this->area;
    }

    function setArea($area)
    {
        $this->area = $area;
        return $this;
    }

    function getPoluchAddress()
    {
        return $this->poluchAddress;
    }

    function setPoluchAddress($poluchAddress)
    {
        $this->poluchAddress = $poluchAddress;
        return $this;
    }
}