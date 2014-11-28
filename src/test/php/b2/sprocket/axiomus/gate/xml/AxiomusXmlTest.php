<?php
namespace b2\sprocket\axiomous\api\xml;

use b2\sprocket\axiomous\api\auth\AxiomusAuth;
use b2\sprocket\axiomous\api\mode\AxiomusMode;

define('B2_FOUNDATION_TEMPLATES','C:\Work\Axiomus\foundation\src\main\php\b2\templates');
define('XML_HEADER', '<?xml version="1.0" encoding="UTF-8"?>');
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\gate\xml\AxiomusXml.php';
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\api\auth\AxiomusAuth.php';
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\api\mode\AxiomusMode.php';
require_once B2_FOUNDATION_TEMPLATES . '\XmlTemplate.php';
require_once B2_FOUNDATION_TEMPLATES . '\XmlTemplateOptions.php';

//require_once 'C:\Work\Axiomus\sprocket-axiomus\src\test\php\b2\sprocket\axiomus\test.boot.php';

class AxiomusXmlTest extends \PHPUnit_Framework_TestCase {

    function testMakeXmlAuth()
    {
        $my = new AxiomusAuth();
        $my->setCheckSum(4)->setUkey(2);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<auth ukey="2" checksum="4"/>',
            //\b2\sprocket\axiomous\api\xml\AxiomusXml::makeXmlAuth(array('ukey'=>2, 'checksum'=>4))
            \b2\sprocket\axiomous\api\xml\AxiomusXml::makeXmlAuth($my)
        );
    }

    function testMakeXmlMode()
    {
        $my = new AxiomusMode();
        $my->setOrderType('new')->setModeType('carry');
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<mode type="carry">new</mode>',
            \b2\sprocket\axiomous\api\xml\AxiomusXml::makeXmlMode(array('orderType'=>'new', 'modeType'=>'new'))
            //\b2\sprocket\axiomous\api\xml\AxiomusXml::makeXmlMode($my)
        );
    }
}
