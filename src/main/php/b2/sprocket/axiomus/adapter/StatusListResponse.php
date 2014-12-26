<?php


namespace b2\sprocket\axiomous\adapter;


class StatusListResponse{
    private $okeyList;

    function getOkeyList()
    {
        return $this->okeyList;
    }

    function setOkeyList($okeyList)
    {
        $this->okeyList = $okeyList;
        return $this;
    }

}