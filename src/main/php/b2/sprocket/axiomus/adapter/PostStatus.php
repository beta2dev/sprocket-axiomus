<?php


namespace b2\sprocket\axiomus\adapter;


class PostStatus {
    private $tracking;
    private $postprice;

    function getTracking()
    {
        return $this->tracking;
    }

    function setTracking($tracking)
    {
        $this->tracking = $tracking;
        return $this;
    }

    function getPostprice()
    {
        return $this->postprice;
    }

    function setPostprice($postprice)
    {
        $this->postprice = $postprice;
        return $this;
    }


}