<?php

namespace b2\sprocket\axiomous\api;

use b2\sprocket\axiomous\api\auth\Auth;

class SingleOrderDeliveryRequest extends SingleOrderRequest
{
    protected $auth;
    protected $order;

    function getAuth()
    {
        return $this->auth;
    }

    function setAuth($auth)
    {
        if (is_string($auth)){
            $this->auth = new Auth();

        }
        else {
            $this->auth = $auth;
        }
        return $this;
    }

    function getOrder()
    {
        return $this->order;
    }

    function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

}