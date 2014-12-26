<?php


namespace b2\sprocket\axiomous\adapter;


class StatusResponse{
    private $order;
    private $status;
    private $dayDate;
    private $refusedItems;
    private $postStatus;
    private $packs;

    function getOrder()
    {
        return $this->order;
    }

    function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    function getStatus()
    {
        return $this->status;
    }

    function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    function getDayDate()
    {
        return $this->dayDate;
    }

    function setDayDate($dayDate)
    {
        $this->dayDate = $dayDate;
        return $this;
    }

    function getRefusedItems()
    {
        return $this->refusedItems;
    }

    function setRefusedItems($refusedItems)
    {
        $this->refusedItems = $refusedItems;
        return $this;
    }

    function getPostStatus()
    {
        return $this->postStatus;
    }

    function setPostStatus($postStatus)
    {
        $this->postStatus = $postStatus;
        return $this;
    }

    function getPacks()
    {
        return $this->packs;
    }

    function setPacks($packs)
    {
        $this->packs = $packs;
        return $this;
    }

}