<?php


namespace b2\sprocket\axiomus\api;


class Item
{
    private $name;
    private $quantity;
    private $price;

    function getName()
    {
        return $this->name;
    }

    function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    function getQuantity()
    {
        return $this->quantity;
    }

    function setQuantity($quantity)
    {
        $this->quantity = $quantity;
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