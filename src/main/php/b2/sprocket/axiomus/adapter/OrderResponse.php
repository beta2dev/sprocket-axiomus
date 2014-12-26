<?php

namespace b2\sprocket\axiomous\adapter;

class OrderResponse{

    protected $auth;
    protected $status;

    function getStatus()
    {
        return $this->status;
    }

    function setStatus($status)
    {
        $this->status = $status;
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

}