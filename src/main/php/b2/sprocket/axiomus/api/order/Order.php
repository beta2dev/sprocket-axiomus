<?php

namespace b2\sprocket\axiomous\api\order;

use b2\sprocket\axiomous\api\order\desc\OrderContent;

class Order
{
    protected $okey;
    protected $innerId;
    protected $name;
    protected $address;
    protected $fromMkad;
    protected $dayDate; // по API d_date - дата (Y-m-d) не ранее сегодня
    protected $beginTime;
    protected $endTime;
    protected $inclDelivSum;
    protected $places;
    protected $city;
    protected $sms;
    protected $smsSender;
    protected $gardenRing;
    protected $email;
    protected $discountValue;
    protected $discountUnit;
    protected $orderContent;

    function getOkey()
    {
        return $this->okey;
    }
    function setOkey($okey)
    {
        $this->okey = $okey;
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
        $this->fromMkad = number_format($fromMkad, 2);
        return $this;
    }

    function getDayDate()
    {
        return $this->dayDate;
    }
    function setDayDate($dayDate)
    {
        if (is_string($dayDate)){
            $this->dayDate = date('Y-m-d', strtotime($dayDate));
        }
        else{
            $this->dayDate = $dayDate;
        }
        return $this;
    }

    function getBeginTime()
    {
        return $this->beginTime;
    }
    function setBeginTime($beginTime)
    {
        $type = gettype($beginTime);
        if (($type == 'integer') || ($type == 'string')){
            $this->beginTime = date('H:00', strtotime($beginTime));
        }
        else{
            $this->beginTime = $beginTime;
        }
        return $this;
    }

    function getEndTime()
    {
        return $this->endTime;
    }
    function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }

    function getInclDelivSum()
    {
        return $this->inclDelivSum;
    }
    function setInclDelivSum($inclDelivSum)
    {
        $this->inclDelivSum = number_format($inclDelivSum, 2);
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

    function getDiscountValue()
    {
        return $this->discountValue;
    }
    function setDiscountValue($discountValue)
    {
        $this->discountValue = number_format($discountValue, 2);
        return $this;
    }

    function getDiscountUnit()
    {
        return $this->discountUnit;
    }
    function setDiscountUnit($discountUnit)
    {
        if ($discountUnit == 0){
            $this->discountUnit = $discountUnit;
        }
        else{
            $this->discountUnit = number_format($discountUnit, 2);
        }
        return $this;
    }

    function getOrderContent()
    {
        return $this->orderContent;
    }
    function setOrderContent($content)
    {
        if (is_array($content)){
            $this->orderContent = new OrderContent();
            foreach($content as $k => $v){
                $str = 'set' . ucfirst($k);
                call_user_func(array($this->orderContent, $str), $v);
            }
        }
        else{
            $this->orderContent = $content;
        }

        return $this;
    }

}