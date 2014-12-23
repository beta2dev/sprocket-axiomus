<?php

namespace b2\sprocket\axiomous\api;

use b2\sprocket\axiomous\api\DelivsetBelow;

class OrderDelivset
{
    protected $abovePrice;
    protected $returnPrice;
    protected $belows;

    function getAbovePrice()
    {
        return $this->abovePrice;
    }
    function setAbovePrice($price)
    {
        $this->abovePrice = number_format($price, 3);
        return $this;
    }

    function getBelows()
    {
        return $this->belows;
    }
    function setBelows($below)
    {
        if (is_array($below)){
            foreach ($below as $key => $val){
                $this->belows[] = new DelivsetBelow();
                foreach ($val as $k => $v){
                    $str = 'set' . ucfirst($k);
                    call_user_func(array($this->belows[$key], $str), $v);
                }
            }
        }
        else{
            $this->belows[] = $below;
        }
        return $this;
    }

    function getReturnPrice()
    {
        return $this->returnPrice;
    }
    function setReturnPrice($price)
    {
        $this->returnPrice = number_format($price, 3);
        return $this;
    }
}
//        belows = [
// *        [
// *              belowPrice = z,
// *              price = n;
// *        ],
// *          ...
// *        [
// *              belowPrice = z,
// *              price = n;
// *        }
// *      ]