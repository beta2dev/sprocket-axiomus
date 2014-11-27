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

    function toArray()
    {
        $buf = array('okey'=>'getOkey', 'innerId'=>'getInnerId', 'name'=>'getName', 'address'=>'getAddress', 'fromMkad'=>'getFromMkad', 'dayDate'=>'getDayDate',
            'beginTime'=>'getBeginTime', 'endTime'=>'getEndTime', 'inclDelivSum'=>'getInclDelivSum', 'places'=>'getPlaces', 'city'=>'getCity', 'sms'=>'getSms',
            'smsSender'=>'getSmsSender', 'gardenRing'=>'getGardenRing', 'email'=>'getEmail', 'exportQuantity'=>'getExportQuantity', 'description'=>'getDescription');
        $out = array();
        foreach($buf as $k => $v){
            if ($v()){
                $out[$k] = $v();
            }
        }
        return $out;
    }
}
