<?php

namespace b2\sprocket\axiomous\api\order\desc;

use b2\sprocket\axiomous\api\order\desc\services\ExportServices;
use b2\sprocket\axiomous\api\order\desc\services\OrderServices;
use b2\sprocket\axiomous\api\order\item\OrderItem;

class OrderContent
{
    protected $contacts;
    protected $description;
    protected $services;
    protected $items;
    protected $delivset;

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
            if (isset($serv['warrant'])){
                $this->services = new ExportServices();
            }
            else{
                $this->services = new OrderServices();
            }
            foreach($serv as $key => $val){
                $str = 'set' . ucfirst($key);
                call_user_func(array($this->services, $str), $val);
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
            if (isset($items['name'])){
                $this->items = new OrderItem();
                foreach($items as $key => $val){
                    $str = 'set' . ucfirst($key);
                    call_user_func(array($this->items, $str), $val);
                }
            }
            else{
                foreach($items as $key => $val){
                    $this->items[] = new OrderItem();
                    foreach($val as $k => $v){
                        $str = 'set' . ucfirst($k);
                        call_user_func(array($this->items[$key], $str), $v);
                    }
                }
            }
        }
        else{
            $this->items = $items;
        }
        return $this;
    }


    /*$items = [
            [
                'name' => 'товар 1',
                'weight' => 2.000,
                'quantity' => 3,
                'price' => 340.55
            ],
            [
                'name' => 'товар 2',
                'weight' => 3.000,
                'quantity' => 5,
                'price' => 555.55
            ]
        ];
    $items = [
            'name' => 'товар 1',
            'weight' => 2.000,
            'quantity' => 3,
            'price' => 340.55
    ]
    */
    function getDelivset()
    {
        return $this->delivset;
    }

    function setDelivset($options)
    {
        $this->delivset = $options;
        return $this;
    }
}
