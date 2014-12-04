<?php

namespace b2\sprocket\axiomous\api;

use b2\sprocket\axiomous\api\auth\Auth;

class SingleOrderCarryStatusRequest extends SingleOrderRequest
{
    protected $auth;

    function getAuth()
    {
        return $this->auth;
    }
    function setAuth($auth)
    {
        if (is_string($auth)){
            $this->auth = new Auth();
            $this->auth->setUkey($auth);
        }
        else{
            $this->auth = $auth;
        }
        return $this;
    }
}