<?php


namespace b2\sprocket\axiomous\adapter;


class Pack {
    private $number;
    private $places;
    private $status;

    function getNumber()
    {
        return $this->number;
    }

    function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    function getPlaces()
    {
        return $this->places;
    }

    function setPlaces($places)
    {
        $this->places = $places;
        return $this;
    }

    function getStatus()
    {
        return $this->status;
    }

    function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

}