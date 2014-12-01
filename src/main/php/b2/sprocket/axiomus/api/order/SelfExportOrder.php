<?php

namespace b2\sprocket\axiomous\api\order;

class SelfExportOrder extends Order
{
    protected $car;

    function getCar()
    {
        return $this->car;
    }
    function setCar($car)
    {
        $this->car = $car;
        return $this;
    }

}