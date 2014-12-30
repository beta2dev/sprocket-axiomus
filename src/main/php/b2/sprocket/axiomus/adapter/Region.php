<?php


namespace b2\sprocket\axiomus\adapter;


class Region {
    private $regionCode;
    private $name;

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