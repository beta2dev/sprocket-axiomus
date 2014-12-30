<?php


namespace b2\sprocket\axiomus\adapter;


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