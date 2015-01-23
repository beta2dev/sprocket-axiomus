<?php

namespace b2\sprocket\axiomus\api;

use b2\sprocket\axiomus\api\DiscountBelow;

class OrderDiscountset
{
    protected $aboveDiscount;
    protected $belows;

    function getAboveDiscount()
    {
        return $this->aboveDiscount;
    }
    function setAboveDiscount($price)
    {
        $this->aboveDiscount = number_format($price, 3);
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
                $this->belows[] = new DiscountBelow();
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

}