<?php


namespace b2\sprocket\axiomus\adapter;


class Order extends ApplicationInfo{

    private $price;
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

    function getPrice()
    {
        return $this->price;
    }

    function setPrice($price)
    {
        $this->price = $price;
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