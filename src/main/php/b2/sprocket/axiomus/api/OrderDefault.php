<?php


namespace b2\sprocket\axiomus\api;


class OrderDefault
{
    protected $okey;
    protected $name;
    protected $orderContent;

    function getOkey()
    {
        return $this->okey;
    }

    function setOkey($okey)
    {
        $this->okey = $okey;
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

    function getOrderContent()
    {
        return $this->orderContent;
    }

    function setOrderContent($orderContent)
    {
        $this->orderContent = $orderContent;
        return $this;
    }
}