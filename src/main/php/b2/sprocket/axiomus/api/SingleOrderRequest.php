<?php

namespace b2\sprocket\axiomous\api;

class SingleOrderRequest
{
    private $mode;
    private $auth;
    private $order;
    private $okey;
    private $okeylist;

    function getMode()
    {
        return $this->mode;
    }

    function setMode($mode)
    {
        if (is_string($mode)){
            $this->mode = new Mode();
            $this->mode->setOrderType($mode);
        }
        else{
            $this->mode = $mode;
        }
        return $this;
    }


    function getOkeylist()
    {
        return $this->okeylist;
    }

    function setOkeylist($okeylist)
    {
        $this->okeylist = $okeylist;
        return $this;
    }

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
        if (is_array($order)){
            $orderTypes = ['carry','export','order','selfExport','post'];
            foreach ($orderTypes as $v){
                if (isset($order[$v])){
                    switch ($v){
                        case 'carry':
                            $this->order = new CarryOrder();
                            break;
                        case 'export':
                            $this->order = new ExportOrder();
                            break;
                        case 'order':
                            $this->order = new Order();
                            break;
                        case 'selfExport':
                            $this->order = new SelfExportOrder();
                            break;
                        case 'post':
                            $this->order = new OrderPost();
                            break;
                    }
                    foreach($order[$v] as $key => $val){
                        $str = 'set' . ucfirst($key);
                        call_user_func(array($this->order, $str), $val);
                    }
                    break;
                }
            }
        }
        else {
            $this->order = $order;
        }
        return $this;
    }

    function getOkey()
    {
        return $this->okey;
    }

    function setOkey($okey)
    {
        $this->okey = $okey;
        return $this;
    }
}