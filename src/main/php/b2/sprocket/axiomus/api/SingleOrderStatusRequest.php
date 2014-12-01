<?php

namespace b2\sprocket\axiomous\api;

class SingleOrderStatusReques extends SingleOrder
{
    protected $okey;
    protected $okeylist;

    function getOkey()
    {
        return $this->okey;
    }

    function setOkey($okey)
    {
        $this->okey = $okey;
        return $this;
    }

    function getOkeylist()
    {
        return $this->okeylist;
    }

    function setOkeylist($okeylist)
    {
        $this->okeylist = $okeylist;
        return $this;
    }
}