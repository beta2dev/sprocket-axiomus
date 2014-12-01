<?php

namespace b2\sprocket\axiomous\api;

class SingleOrder
{
    protected $mode;

    function getMode()
    {
        return $this->mode;
    }

    function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }
}