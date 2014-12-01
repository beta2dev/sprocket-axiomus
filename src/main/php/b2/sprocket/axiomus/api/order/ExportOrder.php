<?php

namespace b2\sprocket\axiomous\api\order;

class ExportOrder extends Order
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
