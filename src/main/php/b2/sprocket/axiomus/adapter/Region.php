<?php


namespace b2\sprocket\axiomous\adapter;


class Region {
    private $regionCode;
    private $regionName;

    function getRegionCode()
    {
        return $this->regionCode;
    }

    function setRegionCode($regionCode)
    {
        $this->regionCode = $regionCode;
        return $this;
    }

    function getRegionName()
    {
        return $this->regionName;
    }

    function setRegionName($regionName)
    {
        $this->regionName = $regionName;
        return $this;
    }


}