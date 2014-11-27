<?php

namespace b2\sprocket\axiomous\api\order;

class AxiomusSelfExportOrder extends AxiomusOrder
{
    protected $car;

    function getCar()
    {
        return $this->car;
    }
    function setCar($car)
    {
        $this->car = $car;
        return $this;
    }

    function toArray()
    {
        $buf = array('okey'=>'getOkey', 'innerId'=>'getInnerId', 'name'=>'getName', 'address'=>'getAddress', 'fromMkad'=>'getFromMkad', 'dayDate'=>'getDayDate',
            'beginTime'=>'getBeginTime', 'endTime'=>'getEndTime', 'inclDelivSum'=>'getInclDelivSum', 'places'=>'getPlaces', 'city'=>'getCity', 'sms'=>'getSms',
            'smsSender'=>'getSmsSender', 'gardenRing'=>'getGardenRing', 'email'=>'getEmail', 'car'=>'getCar', 'description'=>'getDescription');
        $out = array();
        foreach($buf as $k => $v){
            if ($v()){
                $out[$k] = $v();
            }
        }
        return $out;
    }
}