<?php


namespace b2\sprocket\axiomus\adapter;


class ListResponse {
    protected $offices;

    function getOffices()
    {
        return $this->offices;
    }

    function setOffices($offices)
    {
        $this->offices = $offices;
        return $this;
    }
}