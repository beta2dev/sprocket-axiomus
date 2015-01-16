<?php

namespace b2\sprocket\axiomus\gate\xml;

define("LOCAL_PATH", __DIR__ . DIRECTORY_SEPARATOR);

class MakeXml
{

    function singleOrderStatusRequest($status)
    {
        $file = LOCAL_PATH . 'statusRequest.tpl.xml';
        return $this->getXml($status, $file);
    }

    function singleOrderStatusListRequest($status)
    {
        $file = LOCAL_PATH. 'statuslistRequest.tpl.xml';
        return $this->getXml($status, $file);
    }

    function singleOrderDeliveryRequest($delivery)
    {
        $file = LOCAL_PATH . 'deliveryRequest.tpl.xml';
        return $this->getXml($delivery, $file);
    }

    function singleOrderCarryRequest($delivery)
    {
        $file = LOCAL_PATH. 'carryRequest.tpl.xml';
        return $this->getXml($delivery, $file);
    }

    function singleOrderPostRequest($delivery)
    {
        $file = LOCAL_PATH . 'postRequest.tpl.xml';
        return $this->getXml($delivery, $file);
    }

    function singleOrderDpdRequest($delivery)
    {
        $file = LOCAL_PATH . 'dpdRequest.tpl.xml';
        return $this->getXml($delivery, $file);
    }

    function singleOrderCarryStatusRequest($status)
    {
        $file = LOCAL_PATH . 'carryStatusRequest.tpl.xml';
        return $this->getXml($status, $file);
    }

    function singleOrderNewExportRequest($export)
    {
        $file = LOCAL_PATH . 'exportRequest.tpl.xml';
        return $this->getXml($export, $file);
    }

    function singleOrderSelfExportRequest($selfExport)
    {
        $file = LOCAL_PATH . 'selfExportRequest.tpl.xml';
        return $this->getXml($selfExport, $file);
    }

    function singleOrderGetGeographyRequest($geography)
    {
        $file = LOCAL_PATH . 'getGeographyRequest.tpl.xml';
        return $this->getXml($geography, $file);
    }

    function singleOrderRegionCourierRequest($courier)
    {
        $file = LOCAL_PATH . 'regionCourierRequest.tpl.xml';
        return $this->getXml($courier, $file);
    }

    function singleOrderRegionPickupRequest($pickup)
    {
        $file = LOCAL_PATH . 'regionPickupRequest.tpl.xml';
        return $this->getXml($pickup, $file);
    }

    function singleOrderBoxberryPickupRequest($pickup)
    {
        $file = LOCAL_PATH . 'boxberryPickupRequest.tpl.xml';
        return $this->getXml($pickup, $file);
    }

    function singleOrderDeleteRequest($delete)
    {
        $file = LOCAL_PATH . 'deleteRequest.tpl.xml';
        return $this->getXml($delete, $file);
    }

    private function getXml($obj, $string)
    {
        if (file_exists($string)){
            $xml = \b2\templates\XmlTemplate::createFromFile($string);
        }
        else{
            $xml = \b2\templates\XmlTemplate::createFromString($string);
        }
        $xml->setAttributes($obj);
        $options = new \b2\templates\XmlTemplateOptions();
        $options->addConverter('boolean', function($value) {return $value ? 'yes' : 'no';});
        $options->xmlHeader = '<?xml version="1.0" standalone="yes"?>';
        $xml->setOptions($options);
        return $xml->makeSimpleXML()->asXML();
    }
}