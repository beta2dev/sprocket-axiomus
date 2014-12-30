<?php


namespace b2\sprocket\axiomus\adapter;


class Office extends City
{
    protected $officeCode;
    protected $officeName;
    protected $officeAddress;
    protected $type;
    protected $gps;
    protected $area;
    protected $workSchedule;
    protected $cityName;
    protected $code;
    protected $name;
    protected $address;
    protected $region;
    protected $office;

    function getOffice()
    {
        return $this->office;
    }

    function setOffice($office)
    {
        $this->office = $office;
        return $this;
    }


    function getOfficeCode()
    {
        return $this->officeCode;
    }

    function setOfficeCode($officeCode)
    {
        $this->officeCode = $officeCode;
        return $this;
    }

    function getOfficeName()
    {
        return $this->officeName;
    }

    function setOfficeName($officeName)
    {
        $this->officeName = $officeName;
        return $this;
    }

    function getOfficeAddress()
    {
        return $this->officeAddress;
    }

    function setOfficeAddress($officeAddress)
    {
        $this->officeAddress = $officeAddress;
        return $this;
    }

    function getType()
    {
        return $this->type;
    }

    function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    function getGps()
    {
        return $this->gps;
    }

    function setGps($gps)
    {
        $this->gps = $gps;
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

    function getWorkSchedule()
    {
        return $this->workSchedule;
    }

    function setWorkSchedule($workSchedule)
    {
        $this->workSchedule = $workSchedule;
        return $this;
    }

    function getCityName()
    {
        return $this->cityName;
    }

    function setCityName($cityName)
    {
        $this->cityName = $cityName;
        return $this;
    }

    function getCode()
    {
        return $this->code;
    }

    function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    function getName()
    {
        return $this->name;
    }

    function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    function getAddress()
    {
        return $this->address;
    }

    function setAddress($address)
    {
        $this->address = $address;
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