<?php


namespace b2\sprocket\axiomous\adapter;


class VersionResponse{
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