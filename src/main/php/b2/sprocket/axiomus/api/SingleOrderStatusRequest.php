<?php

namespace b2\sprocket\axiomous\api;

class SingleOrderStatusRequest extends SingleOrderRequest
{
    protected $okey;

    function getOkey()
    {
        return $this->okey;
    }

    function setOkey($okey)
    {
        $this->okey = $okey;
        return $this;
    }
}