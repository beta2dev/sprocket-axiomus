<?php

namespace axi\makeorder\order\desc;

class AxiomusOrderContent
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
        $this->services = $serv;
        return $this;
    }

    function getItem()
    {
        return $this->items;
    }

    function setItem($items)
    {
        $this->items = $items;
        return $this;
    }

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
