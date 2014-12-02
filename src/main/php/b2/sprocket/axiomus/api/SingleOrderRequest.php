<?php

namespace b2\sprocket\axiomous\api;

use b2\sprocket\axiomous\api\mode\Mode;

class SingleOrderRequest
{
    protected $mode;

    function getMode()
    {
        return $this->mode;
    }

    function setMode($mode)
    {
        if (is_string($mode)){
            $this->mode = new Mode();
            $this->mode->setOrderType($mode);
        }
        else{
            $this->mode = $mode;
        }
        return $this;
    }
}