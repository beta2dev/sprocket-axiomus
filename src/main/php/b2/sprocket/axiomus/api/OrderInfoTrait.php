<?php


namespace b2\sprocket\axiomus\api;


trait OrderInfoTrait
{
    protected $innerId;
    protected $inclDelivSum;

    function getInnerId()
    {
        return $this->innerId;
    }

    function setInnerId($innerId)
    {
        $this->innerId = $innerId;
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
}