<?php


namespace b2\sprocket\axiomus\api;

/* Заявка на самовывоз BoxBerry (методы new_boxberry_pickup, update_boxberry_pickup) */

class BoxberryPickupOrder extends OrderDefault
{
    use OrderInfoTrait;

    private $dayDate;

    function getDayDate()
    {
        return $this->dayDate;
    }

    function setDayDate($dayDate)
    {
        $this->dayDate = $dayDate;
        return $this;
    } // New // Export // SelfExport // RegionCourier // RegionPickup

}

