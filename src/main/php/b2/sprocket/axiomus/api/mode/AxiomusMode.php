<?php

namespace b2\sprocket\axiomous\api\mode;

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

    function toArray()
    {
        $buf['orderType'] = $this->getOrderType();
        if (isset($this->modeType)){
            $buf['modeType'] = $this->getModeType();
        }
        return $buf;
    }
}