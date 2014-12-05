<?php

namespace b2\sprocket\axiomous\api\order\desc\services;

class PostServices extends OrderServices
{
    protected $valuation;
    protected $fragile;
    protected $cod;
    protected $class1;
    protected $postTarif;
    protected $notAvia;
    protected $waiting;
    protected $optimize;
    protected $smsInform;
    protected $insurance;

    function getValuation()
    {
        return $this->valuation;
    }

    function setValuation($valuation)
    {
        $this->valuation = $valuation;
        return $this;
    }

    function getFragile()
    {
        return $this->fragile;
    }

    function setFragile($fragile)
    {
        $this->fragile = $fragile;
        return $this;
    }

    function getCod()
    {
        return $this->cod;
    }

    function setCod($cod)
    {
        $this->cod = $cod;
        return $this;
    }

    function getClass1()
    {
        return $this->class1;
    }

    function setClass1($class1)
    {
        $this->class1 = $class1;
        return $this;
    }

    function getPostTarif()
    {
        return $this->postTarif;
    }

    function setPostTarif($postTarif)
    {
        $this->postTarif = $postTarif;
        return $this;
    }

    function getNotAvia()
    {
        return $this->notAvia;
    }

    function setNotAvia($notAvia)
    {
        $this->notAvia = $notAvia;
        return $this;
    }

    function getWaiting()
    {
        return $this->waiting;
    }

    function setWaiting($waiting)
    {
        $this->waiting = $waiting;
        return $this;
    }

    function getOptimize()
    {
        return $this->optimize;
    }

    function setOptimize($optimize)
    {
        $this->optimize = $optimize;
        return $this;
    }

    function getSmsInform()
    {
        return $this->smsInform;
    }

    function setSmsInform($smsInform)
    {
        $this->smsInform = $smsInform;
        return $this;
    }

    function getInsurance()
    {
        return $this->insurance;
    }

    function setInsurance($insurance)
    {
        $this->insurance = $insurance;
        return $this;
    }
}