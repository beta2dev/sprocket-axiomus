<?php


namespace b2\sprocket\axiomus\adapter;


class Version {

    private $version;

    function getVersion()
    {
        return $this->version;
    }

    function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

}