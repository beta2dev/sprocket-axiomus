<?php

namespace b2\sprocket\axiomous\api;

use b2\sprocket\axiomous\api\OrderAddress;
use b2\sprocket\axiomous\api\OrderDelivset;
use b2\sprocket\axiomous\api\OrderDiscountset;
use b2\sprocket\axiomous\api\ExportServices;
use b2\sprocket\axiomous\api\OrderServices;
use b2\sprocket\axiomous\api\PostServices;
use b2\sprocket\axiomous\api\OrderItem;

class OrderContent
{
    protected $address;
    protected $contacts;
    protected $description;
    protected $services;
    protected $items;
    protected $delivset;
    protected $discountset;

    function getAddress()
    {
        return $this->address;
    }

    function setAddress($address)
    {
        if (is_array($address)){
            $this->address = new OrderAddress();
            foreach($address as $k => $v){
                $str = 'set' . ucfirst($k);
                call_user_func(array($this->address, $str), $v);
            }
        }
        $this->address = $address;
        return $this;
    }

    function getContacts()
    {
        return $this->contacts;
    }

    function setContacts($number)
    {
        $this->contacts = $number;
        return $this;
    }

    function getDescription()
    {
        return $this->description;
    }

    function setDescription($text)
    {
        $this->description = $text;
        return $this;
    }

    function getServices()
    {
        return $this->services;
    }

    function setServices($serv)
    {
        if (is_array($serv)){
            foreach ($serv as $k => $v){
                switch ($k){
                    case 'warrant': case 'transit':
                        $this->services = new ExportServices();
                        break;
                    case 'cash': case 'cheque': case 'card':
                        $this->services = new OrderServices();
                        break;
                    default:
                        $this->services = new PostServices();
                }
                foreach($serv as $key => $val){
                    $str = 'set' . ucfirst($key);
                    call_user_func(array($this->services, $str), $val);
                }
                break;
            }
        }
        else{
            $this->services = $serv;
        }
        return $this;
    }

    function getItems()
    {
        return $this->items;
    }

    function setItems($items)
    {
        if (is_array($items)){
            foreach($items as $key => $val) {
                $this->items[] = new OrderItem();
                foreach ($val as $k => $v) {
                    $str = 'set' . ucfirst($k);
                    call_user_func(array($this->items[$key], $str), $v);
                }
            }
        }
        else{
            $this->items = $items;
        }
        return $this;
    }

    function getDelivset()
    {
        return $this->delivset;
    }
    function setDelivset($options)
    {
        if (is_array($options)){
            $this->delivset = new OrderDelivset();
            foreach ($options as $key => $val){
                $str = 'set' . ucfirst($key);
                call_user_func(array($this->delivset, $str), $val);
            }
        }
        else{
            $this->delivset = $options;
        }
        return $this;
    }

    function getDiscountset()
    {
        return $this->discountset;
    }

    function setDiscountset($options)
    {
        if (is_array($options)){
            $this->discountset = new OrderDiscountset();
            foreach ($options as $key => $val){
                $str = 'set' . ucfirst($key);
                call_user_func(array($this->discountset, $str), $val);
            }
        }
        else{
            $this->discountset = $options;
        }
        return $this;
    }
}
