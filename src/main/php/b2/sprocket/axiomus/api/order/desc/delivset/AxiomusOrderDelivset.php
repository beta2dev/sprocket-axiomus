<?php

namespace b2\sprocket\axiomous\api\order\desc\delivset;

class AxiomusOrderDelivset
{
    protected $abovePrice;
    protected $belows;
    protected $returnPrice;

    function getAbovePrice()
    {
        return $this->abovePrice;
    }
    function setAbovePrice($price)
    {
        $this->abovePrice = $price;
        return $this;
    }

    function getBelows()
    {
        return $this->belows;
    }
    function setBelows($below)
    {
        $this->belows = $below;
        return $this;
    }

    function getReturnPrice()
    {
        return $this->returnPrice;
    }
    function setReturnPrice($price)
    {
        $this->returnPrice = $price;
        return $this;
    }
}