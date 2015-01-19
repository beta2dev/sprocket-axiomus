<?php

namespace b2\sprocket\axiomus\api;

class SelfExportOrder extends OrderRequest
{
    protected $car;
    protected $quantity;

    function getQuantity()
    {
        return $this->quantity;
    }

    function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

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