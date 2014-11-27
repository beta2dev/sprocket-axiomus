<?php

namespace b2\sprocket\axiomous\api\order;

class AxiomusCarryOrder extends AxiomusOrder
{
    protected $beginDate;
    protected $endDate;
    protected $office;

    function getBeginDate()
    {
        return $this->beginDate;
    }
    function setBeginDate($date)
    {
        $this->beginDate = $date;
        return $this;
    }

    function getEndDate()
    {
        return $this->endDate;
    }
    function setEndDate($date)
    {
        $this->endDate = $date;
        return $this;
    }

    function getOffice()
    {
        return $this->office;
    }
    function setOffice($office)
    {
        $this->office = $office;
        return $this;
    }

    function toArray()
    {
        $buf = array('okey'=>'getOkey', 'innerId'=>'getInnerId', 'name'=>'getName', 'address'=>'getAddress', 'fromMkad'=>'getFromMkad', 'dayDate'=>'getDayDate',
            'beginTime'=>'getBeginTime', 'endTime'=>'getEndTime', 'inclDelivSum'=>'getInclDelivSum', 'places'=>'getPlaces', 'city'=>'getCity', 'sms'=>'getSms',
            'smsSender'=>'getSmsSender', 'gardenRing'=>'getGardenRing', 'email'=>'getEmail', 'beginDate'=>'getBeginDate', 'endDate'=>'getEndDate',
            'office'=>'getOffice', 'description'=>'getDescription');
        $out = array();
        foreach($buf as $k => $v){
            if ($v()){
                $out[$k] = $v();
            }
        }
        return $out;
    }

}