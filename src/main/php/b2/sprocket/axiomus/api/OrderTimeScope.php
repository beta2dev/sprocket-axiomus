<?php


namespace b2\sprocket\axiomus\api;


class OrderTimeScope extends OrderDefault
{
    protected $beginTime;
    protected $endTime;

    function getBeginTime()
    {
        return $this->beginTime;
    }

    function setBeginTime($beginTime)
    {
        $this->beginTime = $beginTime;
        return $this;
    }

    function getEndTime()
    {
        return $this->endTime;
    }

    function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }
}