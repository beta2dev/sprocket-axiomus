<?php

namespace b2\sprocket\axiomous\api\order\desc\address;

class OrderAddress
{
    protected $index;
    protected $region;
    protected $area;
    protected $poluchAddress;

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