<?php


namespace b2\sprocket\axiomus\api;

/* Заявка на самовывоз в регионе Москва и Санкт-Петербург (методы new_carry и update_carry) */

class CarryOrder extends OrderDefault
{
    use OrderInfoTrait;

    private $beginDate;
    private $endDate;
    private $office; // New
    private $places; // New
    private $sms; // New
    private $smsSender; // New
    private $email; // New
    private $discountValue; // New
    private $discountUnit;

    function getBeginDate()
    {
        return $this->beginDate;
    }

    function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;
        return $this;
    }

    function getEndDate()
    {
        return $this->endDate;
    }

    function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }

    function getOffice()
    {
        return $this->office;
    }

    function setOffice($office)
    {
        $this->office = $office;
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

    function getEmail()
    {
        return $this->email;
    }

    function setEmail($email)
    {
        $this->email = $email;
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
    } // New


}