<?php

namespace b2\sprocket\axiomous\api;

class OrderItem
{
    protected $name;
    protected $weight;
    protected $quantity;
    protected $price;
    protected $orderId;
    protected $expmode;


    function getOrderId()
    {
        return $this->orderId;
    }
    function setOrderId($id)
    {
        $this->orderId = $id;
        return $this;
    }

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
        $this->weight = number_format($weight, 3);
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
        $this->price = number_format($price, 2);
        return $this;
    }

    function getExpmode()
    {
        return $this->expmode;
    }
    function setExpmode($expmode)
    {
        $this->expmode = $expmode;
        return $this;
    }

    function asArray()
    {
        $array = ['name' => null, 'weight' => null, 'orderId' => null, 'quantity' => null, 'price' => null, 'expmode' => null];
        foreach ($array as $k => $v){
            if (isset($this->$k)){
                $array[$k] = $this->$k;
            }
            else{
                unset($array[$k]);
            }
        }
        return $array;
    }
}