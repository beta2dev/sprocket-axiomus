<?php


namespace b2\sprocket\axiomus\adapter;


class DayDate {
    private $dayDate;

    function getDayDate()
    {
        return $this->dayDate;
    }

    function setDayDate($dayDate)
    {
        $this->dayDate = $dayDate;
        return $this;
    }
}