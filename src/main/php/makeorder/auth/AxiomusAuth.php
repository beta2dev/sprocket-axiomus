<?php

namespace b2\sprocket\axiomous\api;

class AxiomusAuth
{
    protected $ukey;
    protected $checkSum;

    function getCheckSum()
    {
        return $this->checkSum;
    }
    function setCheckSum($sum)
    {
        $this->checkSum = $sum;
        return $this;
    }

    function getUkey()
    {
        return $this->ukey;
    }
    function setUkey($key)
    {
        $this->ukey = $key;
        return $this;
    }
}