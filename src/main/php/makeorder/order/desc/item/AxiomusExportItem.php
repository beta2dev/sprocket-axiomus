<?php

namespace axi\makeorder\order\desc\item;

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