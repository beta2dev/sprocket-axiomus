<?php


namespace b2\sprocket\axiomous\adapter;


class CarryList {
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