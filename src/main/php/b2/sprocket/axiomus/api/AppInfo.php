<?php


namespace b2\sprocket\axiomus\api;


class AppInfo
{
    private $ukey;
    private $uid;

    function getUkey()
    {
        return $this->ukey;
    }

    function setUkey($ukey)
    {
        $this->ukey = $ukey;
        return $this;
    }

    function getUid()
    {
        return $this->uid;
    }

    function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }
}