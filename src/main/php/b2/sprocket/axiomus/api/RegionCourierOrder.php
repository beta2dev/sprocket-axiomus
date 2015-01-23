<?php


namespace b2\sprocket\axiomus\api;

/* Заявка на доставку в регионы (методы new_region_courier, update_region_courier) */

class RegionCourierOrder extends OrderTimeScope
{
    use OrderInfoTrait;

    protected $dayDate; // New // Export // SelfExport
    protected $email;

    function getDayDate()
    {
        return $this->dayDate;
    }

    function setDayDate($dayDate)
    {
        $this->dayDate = $dayDate;
        return $this;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setEmail($email)
    {
        $this->email = $email;
        return $this;
    } // Carry // New // Post // Dpd

}