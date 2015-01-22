<?php

namespace b2\sprocket\axiomus\api;

class SingleOrderRequest
{
    private $mode;
    private $auth;
    private $order;
    private $okey;
    private $okeylist;

    function getMode()
    {
        return $this->mode;
    }

    function setMode($mode)
    {
        if (is_string($mode)){
            $this->mode = new Mode();
            $this->mode->setOrderType($mode);
        }
        else{
            $this->mode = $mode;
        }
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

    function getAuth()
    {
    return $this->auth;
    }

    function setAuth($auth)
    {
        if (is_string($auth)){
            $this->auth = new AuthRequest();
            $this->auth->setUkey($auth);
        }
        else {
            $this->auth = $auth;
        }
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