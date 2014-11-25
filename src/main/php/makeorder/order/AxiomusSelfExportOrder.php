<?php

namespace axi\makeorder\order;

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