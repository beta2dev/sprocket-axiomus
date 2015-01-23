<?php


namespace b2\sprocket\axiomus\api;

/* Заявка на привоз товара на наш склад в регионе Москва (методы new_self_export и update_self_export)  */

class SelfExportOrder extends OrderTimeScope
{
    private $car;
    private $dayDate; // New // Export
    private $quantity;
    private $places; // New // Carry
    private $transit;

    function getCar()
    {
        return $this->car;
    }

    function setCar($car)
    {
        $this->car = $car;
        return $this;
    }

    function getDayDate()
    {
        return $this->dayDate;
    }

    function setDayDate($dayDate)
    {
        $this->dayDate = $dayDate;
        return $this;
    }

    function getQuantity()
    {
        return $this->quantity;
    }

    function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    function getPlaces()
    {
        return $this->places;
    }

    function setPlaces($places)
    {
        $this->places = $places;
        return $this;
    }

    function getTransit()
    {
        return $this->transit;
    }

    function setTransit($transit)
    {
        $this->transit = $transit;
        return $this;
    }
}