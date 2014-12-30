<?php


namespace b2\sprocket\axiomus\adapter;


class Status {
    private $price;
    private $code;
    private $status;

    function getPrice()
    {
        return $this->price;
    }

    function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    function getCode()
    {
        return $this->code;
    }

    function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    function getStatus()
    {
        return $this->status;
    }

    function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

}