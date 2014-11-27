<?php

namespace b2\sprocket\axiomous\api\auth;

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

    function toArray()
    {
        $buf['ukey'] = $this->getUkey();
        if (isset($this->checkSum)){
            $buf['checksum'] = $this->getCheckSum();
        }
        return $buf;
    }
}