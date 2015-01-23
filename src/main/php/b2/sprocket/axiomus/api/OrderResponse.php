<?php


namespace b2\sprocket\axiomus\api;


class OrderResponse extends ApplicationInfo
{
    private $price;
    private $inclDelivSum;
    private $exportOrder;
    private $fid;
    private $returnOrder;
    private $group;
    private $statusCode;
    private $statusName;
    private $totalPrice;
    private $agentPrice;
    private $subagentPrice;

    function getTotalPrice()
    {
        return $this->totalPrice;
    }

    function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    function getAgentPrice()
    {
        return $this->agentPrice;
    }

    function setAgentPrice($agentPrice)
    {
        $this->agentPrice = $agentPrice;
        return $this;
    }

    function getSubagentPrice()
    {
        return $this->subagentPrice;
    }

    function setSubagentPrice($subagentPrice)
    {
        $this->subagentPrice = $subagentPrice;
        return $this;
    }

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