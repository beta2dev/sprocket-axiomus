<?php

namespace b2\sprocket\axiomous\api\order;

class AxiomusSelfExportOrder extends AxiomusOrder
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