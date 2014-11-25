<?php

namespace axi\makeorder\order;

class AxiomusOrder
{
    protected $oKey;
    protected $innerId;
    protected $name;
    protected $address;
    protected $fromMkad;
    protected $dDate;
    protected $bTime;
    protected $eTime;
    protected $inclDelivSum;
    protected $places;
    protected $city;
    protected $sms;
    protected $smsSender;
    protected $gardenRing;
    protected $email;
    protected $description;

    function getOKey()
    {
        return $this->oKey;
    }
    function setOKey($oKey)
    {
        $this->oKey = $oKey;
        return $this;
    }

    function getInnerId()
    {
        return $this->innerId;
    }
    function setInnerId($innerId)
    {
        $this->innerId = $innerId;
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

    function getFromMkad()
    {
        return $this->fromMkad;
    }
    function setFromMkad($fromMkad)
    {
        $this->fromMkad = $fromMkad;
        return $this;
    }

    function getDDate()
    {
        return $this->dDate;
    }
    function setDDate($dDate)
    {
        $this->dDate = $dDate;
        return $this;
    }

    function getBTime()
    {
        return $this->bTime;
    }
    function setBTime($bTime)
    {
        $this->bTime = $bTime;
        return $this;
    }

    function getETime()
    {
        return $this->eTime;
    }
    function setETime($eTime)
    {
        $this->eTime = $eTime;
        return $this;
    }

    function getInclDelivSum()
    {
        return $this->inclDelivSum;
    }
    function setInclDelivSum($inclDelivSum)
    {
        $this->inclDelivSum = $inclDelivSum;
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

    function getEmail()
    {
        return $this->email;
    }
    function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    function getDescription()
    {
        return $this->description;
    }
    function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}