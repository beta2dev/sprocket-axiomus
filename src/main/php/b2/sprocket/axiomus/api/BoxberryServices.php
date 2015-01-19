<?php

namespace b2\sprocket\axiomus\api;


class BoxberryServices extends OrderServices
{
    private $checkup;

    function getCheckup()
    {
        return $this->checkup;
    }

    function setCheckup($checkup)
    {
        $this->checkup = $checkup;
        return $this;
    }
}