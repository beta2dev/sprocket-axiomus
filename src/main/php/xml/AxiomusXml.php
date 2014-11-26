<?php

namespace b2\sprocket\axiomous\api;

class AxiomusXml
{

    static function makeXmlAuth(AxiomusAuth $auth)
    {
        $string = '<auth xmlns:a="b2tplxml" ukey="$ukey" checksum="?$checksum" />';
        $xml = \b2\templates\XmlTemplate::createFromString($string);
        $xml->setAttributes(array(
            'ukey' => $auth->getUkey(),
            'checksum' => $auth->getCheckSum()
        ));
        return $xml->makeSimpleXML()->asXML();
    }

    static function makeXmlMode(AxiomusMode $mode)
    {
        $string = '<mode xmlns:a="b2tplxml" type="?$modeType" a:text="$orderType"></mode>';
        $xml = \b2\templates\XmlTemplate::createFromString($string);
        $xml->setAttributes(array(
            'modeType' => $mode->getModeType(),
            'orderType' => $mode->getOrderType()
        ));
        return $xml->makeSimpleXML()->asXML();
    }

    static function makeXmlOrder()
    {

    }
}