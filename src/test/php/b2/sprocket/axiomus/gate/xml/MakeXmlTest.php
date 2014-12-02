<?php

namespace b2\sprocket\axiomous\gate\xml;

use b2\sprocket\axiomous\api\auth\Auth;
use b2\sprocket\axiomous\api\order\Order;
use b2\sprocket\axiomous\api\SingleOrderDeliveryRequest;

define('B2_FOUNDATION_TEMPLATES','C:\Work\Axiomus\foundation\src\main\php\b2\templates');
define('XML_HEADER', '<?xml version="1.0" encoding="UTF-8"?>');

require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\gate\xml\MakeXml.php';
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\api\auth\Auth.php';
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\api\mode\Mode.php';
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\api\order\Order.php';
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\api\SingleOrderRequest.php';
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\api\SingleOrderStatusRequest.php';
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\api\SingleOrderStatusListRequest.php';
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\api\SingleOrderDeliveryRequest.php';
require_once B2_FOUNDATION_TEMPLATES . '\..\util\String.php';
require_once B2_FOUNDATION_TEMPLATES . '\XmlTemplate.php';
require_once B2_FOUNDATION_TEMPLATES . '\XmlTemplateOptions.php';

//require_once 'C:\Work\Axiomus\sprocket-axiomus\src\test\php\b2\sprocket\axiomus\test.boot.php';

class MakeXmlTest extends \PHPUnit_Framework_TestCase {

    function testSingleOrderStatusRequest()
    {
        $status = new \b2\sprocket\axiomous\api\SingleOrderStatusRequest();
        $xml = new MakeXml();

        $status->setMode('status')->setOkey('23fs2fsd3');

        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<singleorder><mode>status</mode><okey>23fs2fsd3</okey></singleorder>',
            //$xml->SingleOrderStatusRequest(array('okey'=>'23fs2fsd3', 'mode'=>array('orderType'=>'status')))
            $xml->SingleOrderStatusRequest($status)
        );
    }

    function testSingleOrderStatusListRequest()
    {
        $statusList = new \b2\sprocket\axiomous\api\SingleOrderStatusListRequest();
        $xml = new MakeXml();

        $statusList->setMode('status')->setOkeylist([1,2,3]);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<singleorder><mode>status</mode><okeylist><okey>1</okey><okey>2</okey><okey>3</okey></okeylist></singleorder>',
            $xml->SingleOrderStatusListRequest($statusList)
        );
    }

    function testSingleOrderDeliveryRequest()
    {
        $delivery = new SingleOrderDeliveryRequest();
        $auth = new Auth();
        $xml = new MakeXml();
        $order = array(
            'order' => [
                'innerId'=>'123',
                'name'=>'Кл',
                'address'=>'Москва...',
                'fromMkad'=>'0',
                'dayDate'=>'2009-16-15',
                'beginTime'=>'12:00',
                'endTime'=>'13:00',
                'inclDelivSum'=>'200.15',
                'places'=>'1',
                'city'=>'0',
                'sms'=>'8905',
                'description'=>'a'
            ]);
        $auth->setCheckSum('123qwe')->setUkey('321ewq');

        $delivery->setMode('new')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <auth ukey="321ewq" checksum="123qwe"/>
                <mode>new</mode>
                <order inner_id="123" name="Кл" address="Москва..." from_mkad="0" d_date="2009-16-15" b_time="12:00" e_time="13:00" incl_deliv_sum="200.15" places="1" city="0" sms="8905">b</order>
            </singleorder>',
            $xml->SingleOrderDeliveryRequest($delivery)
        );
    }
    /*
        function testMakeXmlAuth()
        {
            $my = new Auth();
            $my->setCheckSum(4)->setUkey(2);
            $this->assertXmlStringEqualsXmlString(
                XML_HEADER . '<auth ukey="2" checksum="4"/>',
                //\b2\sprocket\axiomous\api\xml\AxiomusXml::makeXmlAuth(array('ukey'=>2, 'checksum'=>4))
                \b2\sprocket\axiomous\gate\xml\MakeXml::makeXmlAuth($my)
            );
        }

        function testMakeXmlMode()
        {
            $my = new Mode();
            $my->setOrderType('new')->setModeType('carry');
            $this->assertXmlStringEqualsXmlString(
                XML_HEADER . '<mode type="carry">new</mode>',
                //\b2\sprocket\axiomous\api\xml\AxiomusXml::makeXmlMode(array('orderType'=>'new', 'modeType'=>'new'))
                \b2\sprocket\axiomous\gate\xml\MakeXml::makeXmlMode($my)
            );
        }*/
}
