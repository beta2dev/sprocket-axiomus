<?php

namespace b2\sprocket\axiomous\api\order;

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
