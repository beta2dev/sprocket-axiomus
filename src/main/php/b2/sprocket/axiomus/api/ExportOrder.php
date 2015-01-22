<?php


namespace b2\sprocket\axiomus\api;

/* Заявка на забор товара из интернет-магазина в регионе Москва (методы new_export и update_export) */

class ExportOrder extends OrderTimeScope
{
    private $address;
    private $fromMkad; // New
    private $dayDate; // New
    private $exportQuantity;
    private $gardenRing;

    function getAddress()
    {
        return $this->address;
    }

    function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    function getFromMkad()
    {
        return $this->fromMkad;
    }

    function setFromMkad($fromMkad)
    {
        $this->fromMkad = $fromMkad;
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

    function getExportQuantity()
    {
        return $this->exportQuantity;
    }

    function setExportQuantity($exportQuantity)
    {
        $this->exportQuantity = $exportQuantity;
        return $this;
    }

    function getGardenRing()
    {
        return $this->gardenRing;
    }

    function setGardenRing($gardenRing)
    {
        $this->gardenRing = $gardenRing;
        return $this;
    } // New


}