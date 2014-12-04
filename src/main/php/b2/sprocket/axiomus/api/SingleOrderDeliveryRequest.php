<?php

namespace b2\sprocket\axiomous\api;

use b2\sprocket\axiomous\api\auth\Auth;
use b2\sprocket\axiomous\api\order\CarryOrder;
use b2\sprocket\axiomous\api\order\ExportOrder;
use b2\sprocket\axiomous\api\order\Order;
use b2\sprocket\axiomous\api\order\SelfExportOrder;

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
        if (is_array($auth)){
            $this->auth = new Auth();
            foreach($auth as $key => $val){
                $str = 'set' . ucfirst($key);
                call_user_func(array($this->auth, $str), $val);
            }
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
            $orderTypes = ['carry','export','order','selfExport'];
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

}