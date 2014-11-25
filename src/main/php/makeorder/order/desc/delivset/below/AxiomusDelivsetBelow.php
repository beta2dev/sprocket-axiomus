<?php

namespace axi\makeorder\order\desc\delivset\below;

class AxiomusDelivsetBelow
{
    protected $belowSum;
    protected $price;

    function getBelowSum()
    {
        return $this->belowSum;
    }
    function setBelowSum($sum)
    {
        $this->belowSum = $sum;
        return $this;
    }

    function getPrice()
    {
        return $this->price;
    }
    function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}