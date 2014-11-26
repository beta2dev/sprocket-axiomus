<?php

namespace b2\sprocket\axiomous\api;

class AxiomusMode
{
    protected $orderType; // new, new_carry, update... etc; при запросе стоимости услуги всегда = get_price
    protected $modeType; // при запросе стоимости услуги type="carry", type="delivery".. etc

    function getOrderType()
    {
        return $this->orderType;
    }

    function setOrderType($orderType)
    {
        $this->orderType = $orderType;
        return $this;
    }

    function getModeType()
    {
        return $this->modeType;
    }

    function setModeType($modeType)
    {
        $this->modeType = $modeType;
        return $this;
    }
}