<?php


namespace b2\sprocket\axiomus\api;

/* Заявка на доставку в регионе Москва и Санкт-Петербург(методы new и update) */

class NewOrder extends RegionCourierOrder
{

    private $address;
    private $fromMkad;
    private $places;
    private $city;
    private $sms;
    private $smsSender;
    private $gardenRing;
    private $discountValue;
    private $discountUnit;

    function getAddress()
    {
        return $this->address;
    }

    function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    function getFromMkad()
    {
        return $this->fromMkad;
    }

    function setFromMkad($fromMkad)
    {
        $this->fromMkad = $fromMkad;
        return $this;
    }


    function getPlaces()
    {
        return $this->places;
    }

    function setPlaces($places)
    {
        $this->places = $places;
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

    function getSms()
    {
        return $this->sms;
    }

    function setSms($sms)
    {
        $this->sms = $sms;
        return $this;
    }

    function getSmsSender()
    {
        return $this->smsSender;
    }

    function setSmsSender($smsSender)
    {
        $this->smsSender = $smsSender;
        return $this;
    }

    function getGardenRing()
    {
        return $this->gardenRing;
    }

    function setGardenRing($gardenRing)
    {
        $this->gardenRing = $gardenRing;
        return $this;
    }

    function getDiscountValue()
    {
        return $this->discountValue;
    }

    function setDiscountValue($discountValue)
    {
        $this->discountValue = $discountValue;
        return $this;
    }

    function getDiscountUnit()
    {
        return $this->discountUnit;
    }

    function setDiscountUnit($discountUnit)
    {
        $this->discountUnit = $discountUnit;
        return $this;
    }

}