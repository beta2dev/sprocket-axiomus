<?php

namespace axi\makeorder\order;

class AxiomusExportOrder extends AxiomusOrder
{
    protected $exportQuantity;

    function getExportQuantity()
    {
        return $this->exportQuantity;
    }
    function setExportQuantity($count)
    {
        $this->exportQuantity = $count;
        return $this;
    }
}
