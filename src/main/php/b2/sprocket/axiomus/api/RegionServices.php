<?php

namespace b2\sprocket\axiomous\api;

class RegionServices extends OrderServices
{
    protected $notOpen;
    protected $extrapack;

    function getNotOpen()
    {
        return $this->notOpen;
    }

    function setNotOpen($notOpen)
    {
        $this->notOpen = $notOpen;
        return $this;
    }

    function getExtrapack()
    {
        return $this->extrapack;
    }

    function setExtrapack($extrapack)
    {
        $this->extrapack = $extrapack;
        return $this;
    }
}