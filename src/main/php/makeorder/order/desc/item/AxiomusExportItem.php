<?php

namespace b2\sprocket\axiomous\api;

class AxiomusExportItem extends AxiomusOrderItem
{
    protected $oId;

    function getOId()
    {
        return $this->oId;
    }
    function setOId($id)
    {
        $this->oId = $id;
        return $this;
    }
}