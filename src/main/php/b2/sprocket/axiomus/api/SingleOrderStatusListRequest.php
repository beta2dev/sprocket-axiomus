<?php

namespace b2\sprocket\axiomous\api;

class SingleOrderStatusListRequest extends SingleOrderRequest
{
    protected $okeylist;

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