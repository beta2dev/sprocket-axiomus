<?php

namespace axi\makeorder\mode;

class AxiomusMode
{
    protected $mode;
    protected $modeType;

    function getMode()
    {
        return $this->mode;
    }
    function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }

    function getModeType()
    {
        return $this->modeType;
    }
    function setModeType($modeType)
    {
        $this->modeType = $modeType;
        return $this;
    }



}