<?php


namespace b2\sprocket\axiomus\adapter;


class ApplicationInfo {
    protected $id;
    protected $innerId;
    protected $customerPrice;

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    function getInnerId()
    {
        return $this->innerId;
    }

    function setInnerId($innerId)
    {
        $this->innerId = $innerId;
        return $this;
    }

    function getCustomerPrice()
    {
        return $this->customerPrice;
    }

    function setCustomerPrice($customerPrice)
    {
        $this->customerPrice = $customerPrice;
        return $this;
    }
}