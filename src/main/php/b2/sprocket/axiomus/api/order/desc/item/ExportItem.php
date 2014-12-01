<?php

namespace b2\sprocket\axiomous\api\order\item;

class ExportItem extends OrderItem
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