<?php

namespace b2\sprocket\axiomous\api\order\item;

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