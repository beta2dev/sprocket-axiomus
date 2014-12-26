<?php


namespace b2\sprocket\axiomous\gate\xml;


define('B2_FOUNDATION_TEMPLATES','C:\Work\Axiomus\foundation\src\main\php\b2\templates');
define('B2_AXIOMUS_TEMPLATES','C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus');

require_once B2_AXIOMUS_TEMPLATES . '\gate\xml\XmlGet.php';
//require_once B2_AXIOMUS_TEMPLATES . '\adapter\Response.php';

require_once __DIR__ . '\..\..\..\test.boot.php';

$GLOBALS['b2foundation'] = 'C:\Work\Axiomus\foundation\src\main\php';
require_once 'C:\Work\Axiomus\foundation\src\main\php\b2\sys\classloading.php';
b2classpath('C:\Work\Axiomus\sprocket-axiomus\src\main\php');

class XmlGetTest extends \PHPUnit_Framework_TestCase {

    private $mapper;

    protected function setUp()
    {
        $this->mapper = new XmlGet();
    }

    function testNewOrderResponse()
    {
        $xml = '<response>
                    <request>new</request>>
                    <auth objectid="123">asd</auth>
                    <status price="123.456" code="0">success</status>
                </response>
                ';
        $obj = $this->mapper->map($xml);
        var_dump($obj);
    }
}
