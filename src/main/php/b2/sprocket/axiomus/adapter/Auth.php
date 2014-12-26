<?php


namespace b2\sprocket\axiomous\adapter;


class Auth{
    private $objectid;
    private $auth;

    function getObjectId()
    {
        return $this->objectid;
    }

    function setObjectid($objectid)
    {
        $this->objectid = $objectid;
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