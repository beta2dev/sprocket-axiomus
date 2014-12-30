<?php


namespace b2\sprocket\axiomus\adapter;


class Order {
    private $id;
    private $innerId;
    private $price;
    private $customerPrice;
    private $inclDelivSum;
    private $exportOrder;
    private $fid;
    private $returnOrder;
    private $group;
    private $statusCode;
    private $statusName;

    function getFid()
    {
        return $this->fid;
    }

    function setFid($fid)
    {
        $this->fid = $fid;
        return $this;
    }

    function getStatusCode()
    {
        return $this->statusCode;
    }

    function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    function getStatusName()
    {
        return $this->statusName;
    }

    function setStatusName($statusName)
    {
        $this->statusName = $statusName;
        return $this;
    }

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

    function getPrice()
    {
        return $this->price;
    }

    function setPrice($price)
    {
        $this->price = $price;
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

    function getInclDelivSum()
    {
        return $this->inclDelivSum;
    }

    function setInclDelivSum($inclDelivSum)
    {
        $this->inclDelivSum = $inclDelivSum;
        return $this;
    }

    function getExportOrder()
    {
        return $this->exportOrder;
    }

    function setExportOrder($exportOrder)
    {
        $this->exportOrder = $exportOrder;
        return $this;
    }

    function getReturnOrder()
    {
        return $this->returnOrder;
    }

    function setReturnOrder($returnOrder)
    {
        $this->returnOrder = $returnOrder;
        return $this;
    }

    function getGroup()
    {
        return $this->group;
    }

    function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

}