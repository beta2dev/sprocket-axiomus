<?php

namespace b2\sprocket\axiomous\api\order\desc\delivset\below;

class DelivsetBelow
{
    protected $belowSum;
    protected $price;

    function getBelowSum()
    {
        return $this->belowSum;
    }
    function setBelowSum($sum)
    {
        $this->belowSum = number_format($sum, 3, '.', '');
        return $this;
    }

    function getPrice()
    {
        return $this->price;
    }
    function setPrice($price)
    {
        $this->price = number_format($price, 3);
        return $this;
    }
}