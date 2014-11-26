<?php

namespace b2\sprocket\axiomous\api;

class AxiomusOrderItem
{
    protected $name;
    protected $weight;
    protected $quantity;
    protected $price;

    function getName()
    {
        return $this->name;
    }
    function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    function getWeight()
    {
        return $this->weight;
    }
    function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    function getQuantity()
    {
        return $this->quantity;
    }
    function setQuantity($count)
    {
        $this->quantity = $count;
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