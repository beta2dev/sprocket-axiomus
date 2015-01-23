<?php

namespace b2\sprocket\axiomus\gate;

define("LOCAL_PATH", __DIR__ . DIRECTORY_SEPARATOR . 'xml' . DIRECTORY_SEPARATOR);

class XmlMake
{

    function makeXml($xmlObj)
    {
        $orderType = $xmlObj->getMode()->getOrderType();
        $orderTypeArr = explode('_', $orderType);
        $resultXml = null;
        switch ($orderTypeArr[0])
        {
            case 'status':
                $resultXml = $orderType == 'status' ? $this->singleOrderStatusRequest($xmlObj) : $this->singleOrderStatusListRequest($xmlObj);
                break;
            case 'delete':
                $resultXml = $this->singleOrderDeleteRequest($xmlObj);
                break;
            case 'get':
                if ($orderType != 'get_price') {
                    $resultXml = $this->singleOrderGetGeographyRequest($xmlObj);
                    break;
                }
                // break; - здесь быть не должно тк все заявки get_price обрабатываются так же как и заявки на доставку
            default:
                $resultXml = $orderType == 'get_price' ? $this->orderRequest($xmlObj, $xmlObj->getMode()->getModeType(), true) : $this->orderRequest($xmlObj, $orderType);

        }
        return $resultXml;
    }

    private function orderRequest($order, $orderType, $isGetPrice = false)
    {
        if ($orderType == 'new' || $orderType == 'update')
            $orderType = 'new_delivery';

        $type = explode('_', $orderType);
        $opt = $isGetPrice ? $type[0] : $type[1];

        $result = null;
        switch ($opt)
        {
            case 'delivery':
                $result = $this->singleOrderDeliveryRequest($order);
                break;
            case 'carry':
                $result = $this->singleOrderCarryRequest($order);
                break;
            case 'export':
                $result = $this->singleOrderExportRequest($order);
                break;
            case 'self':
                $result = $this->singleOrderSelfExportRequest($order);
                break;
            case 'post':
                $result = $this->singleOrderPostRequest($order);
                break;
            case 'dpd':
                $result = $this->singleOrderDpdRequest($order);
                break;
            case 'region':
                $result = $type[count($type) - 1] == 'courier' ? $this->singleOrderRegionCourierRequest($order) : $this->singleOrderRegionPickupRequest($order);
                break;
            case 'boxberry':
                $result = $this->singleOrderBoxberryPickupRequest($order);
                break;
        }
        return $result;
    }

    private function singleOrderStatusRequest($status)
    {
        $file = LOCAL_PATH . 'statusRequest.tpl.xml';
        return $this->getXml($status, $file);
    }

    private function singleOrderStatusListRequest($status)
    {
        $file = LOCAL_PATH. 'statuslistRequest.tpl.xml';
        return $this->getXml($status, $file);
    }

    private function singleOrderDeliveryRequest($delivery)
    {
        $file = LOCAL_PATH . 'deliveryRequest.tpl.xml';
        return $this->getXml($delivery, $file);
    }

    private function singleOrderCarryRequest($delivery)
    {
        $file = LOCAL_PATH. 'carryRequest.tpl.xml';
        return $this->getXml($delivery, $file);
    }

    private function singleOrderPostRequest($delivery)
    {
        $file = LOCAL_PATH . 'postRequest.tpl.xml';
        return $this->getXml($delivery, $file);
    }

    private function singleOrderDpdRequest($delivery)
    {
        $file = LOCAL_PATH . 'dpdRequest.tpl.xml';
        return $this->getXml($delivery, $file);
    }

    private function singleOrderExportRequest($export)
    {
        $file = LOCAL_PATH . 'exportRequest.tpl.xml';
        return $this->getXml($export, $file);
    }

    private function singleOrderSelfExportRequest($selfExport)
    {
        $file = LOCAL_PATH . 'selfExportRequest.tpl.xml';
        return $this->getXml($selfExport, $file);
    }

    private function singleOrderGetGeographyRequest($geography)
    {
        $file = LOCAL_PATH . 'getGeographyRequest.tpl.xml';
        return $this->getXml($geography, $file);
    }

    private function singleOrderRegionCourierRequest($courier)
    {
        $file = LOCAL_PATH . 'regionCourierRequest.tpl.xml';
        return $this->getXml($courier, $file);
    }

    private function singleOrderRegionPickupRequest($pickup)
    {
        $file = LOCAL_PATH . 'regionPickupRequest.tpl.xml';
        return $this->getXml($pickup, $file);
    }

    private function singleOrderBoxberryPickupRequest($pickup)
    {
        $file = LOCAL_PATH . 'boxberryPickupRequest.tpl.xml';
        return $this->getXml($pickup, $file);
    }

    private function singleOrderDeleteRequest($delete)
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