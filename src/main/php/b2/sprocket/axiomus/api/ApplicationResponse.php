<?php


namespace b2\sprocket\axiomus\api;


class ApplicationResponse
{
    private $order;
    private $dayDate;
    private $auth;
    private $status;
    private $version;

    function getVersion()
    {
        return $this->version;
    }

    function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    function getAuth()
    {
        return $this->auth;
    }

    function setAuth($auth)
    {
        $this->auth = $auth;
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

    function getOrder()
    {
        return $this->order;
    }

    function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    function getDayDate()
    {
        return $this->dayDate;
    }

    function setDayDate($dayDate)
    {
        $this->dayDate = $dayDate;
        return $this;
    }
}