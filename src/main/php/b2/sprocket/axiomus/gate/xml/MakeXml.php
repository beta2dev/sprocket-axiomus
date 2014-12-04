<?php

namespace b2\sprocket\axiomous\gate\xml;

class MakeXml
{
    function SingleOrderStatusRequest($status)
    {
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'status.tpl.xml';
        return $this->getXml($status, $file);
    }

    function SingleOrderStatusListRequest($status)
    {
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'statuslist.tpl.xml';
        return $this->getXml($status, $file);
    }

    function SingleOrderDeliveryRequest($delivery)
    {
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'deliveryOrder.tpl.xml';
        return $this->getXml($delivery, $file);
    }

    function SingleOrderCarryStatusRequest($status)
    {
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'carryStatusOrder.tpl.xml';
        return $this->getXml($status, $file);
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
        $xml->setOptions($options);
        return $xml->makeSimpleXML()->asXML();
    }
}