<?php

namespace b2\sprocket\axiomous\api;

class DiscountBelow
{
    protected $belowSum;
    protected $discount;

    function getBelowSum()
    {
        return $this->belowSum;
    }
    function setBelowSum($belowSum)
    {
        $this->belowSum = number_format($belowSum, 3, '.', '');
        return $this;
    }

    function getDiscount()
    {
        return $this->discount;
    }
    function setDiscount($discount)
    {
        $this->discount = number_format($discount, 3);
        return $this;
    }
}