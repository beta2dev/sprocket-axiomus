<?php


namespace b2\sprocket\axiomous\adapter;


class Request {

    protected $request;

    function getRequest()
    {
        return $this->request;
    }

    function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }
}