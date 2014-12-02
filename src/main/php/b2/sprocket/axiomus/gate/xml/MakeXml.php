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
    }/*
    static function makeXmlAuth($auth)
    {
        $string = '<auth xmlns:a="b2tplxml" ukey="$ukey" checksum="?$checksum" />';
        return self::getXml($auth, $string);
    }

    static function makeXmlMode($mode)
    {
        $string = '<mode xmlns:a="b2tplxml" type="?$modeType" a:text="$orderType"/>';
        return self::getXml($mode, $string);
    }

    static function makeXmlOrder($order)
    {
        $string = '<order xmlns:a="b2tplxml" okey="?$okey" inner_id="?$innerId" name="$name" b_date="?$beginDate" e_date="?$endDate" address="?$address"
                    from_mkad="?$fromMkad" d_date="?$dayDate" b_time="?$beginTime" e_time="?$endTime" incl_deliv_sum="?$inclDelivSum" places="$places"
                    city="?$city" sms="?$sms" sms_sender="?$smsSender" garden_ring="?$gardenRing" email="?$email" car="?$car" office="?$office" export_quantity="?$exportQuantity"
                    a:text="$description"></order>';
        return self::getXml($order, $string);
    }
*/
    private function getXml($obj, $string)
    {
        if (file_exists($string)){
            $xml = \b2\templates\XmlTemplate::createFromFile($string);
        }
        else{
            $xml = \b2\templates\XmlTemplate::createFromString($string);
        }
        $xml->setAttributes($obj);
        return $xml->makeSimpleXML()->asXML();
    }
}