<?php


namespace b2\sprocket\axiomus\api;


class GetListResponse
{
    protected $list;

    function getList()
    {
        return $this->list;
    }

    function setList($list)
    {
        $this->list = $list;
        return $this;
    }
}