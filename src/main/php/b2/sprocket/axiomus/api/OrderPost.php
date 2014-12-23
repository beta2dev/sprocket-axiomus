<?php

namespace b2\sprocket\axiomous\api;

class OrderPost extends Order
{
    protected $postType;

    function getPostType()
    {
        return $this->postType;
    }

    function setPostType($postType)
    {
        $this->postType = $postType;
        return $this;
    }
}