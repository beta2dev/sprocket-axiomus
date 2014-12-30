<?php

namespace b2\sprocket\axiomus\gate\xml;

use b2\sprocket\axiomus\adapter\Auth;
use b2\sprocket\axiomus\adapter\CarryList;
use b2\sprocket\axiomus\adapter\DayDate;
use b2\sprocket\axiomus\adapter\Item;
use b2\sprocket\axiomus\adapter\ItemsRefused;
use b2\sprocket\axiomus\adapter\ListResponse;
use b2\sprocket\axiomus\adapter\Office;
use b2\sprocket\axiomus\adapter\Order;
use b2\sprocket\axiomus\adapter\PostStatus;
use b2\sprocket\axiomus\adapter\Request;
use b2\sprocket\axiomus\adapter\Response;
use b2\sprocket\axiomus\adapter\Status;

require_once __DIR__ . '\..\..\..\test.boot.php';
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\gate\xml\XmlGet.php';

class XmlGetTest extends \PHPUnit_Framework_TestCase {

    private $mapper;

    protected function setUp()
    {
        $this->mapper = new XmlGet();
    }

    function testNewOrderResponse()
    {
        $xml = '<response>
                    <request>new</request>
                    <auth objectid="123">asd</auth>
                    <status price="123.456" code="0">success</status>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        $expected = new Response();
        $expected->setItems([(new Request())->setRequest('new'),(new Auth())->setAuth('asd')->setObjectid(123),(new Status())->setCode(0)->setPrice(123.456)->setStatus('success')]);
        $this->assertEquals(print_r($expected, true), print_r($obj, true));
    }

    function testListStatusResponse()
    {
        $xml = '<response>
                    <request>status</request>
                    <order id="1013" inner_id="167" price="123.23" customer_price="132.00" incl_deliv_sum="430.12" group="321" export_order="4321" fid="654"/>
                    <status code="211">ras</status>
                    <d_date>2011-13-15</d_date>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        $expected = new Response();
        $expected->setItems([
            (new Request())->setRequest('status'),
            (new Order())->setId(1013)->setInnerId(167)->setPrice(123.23)->setCustomerPrice(132.00)->setInclDelivSum(430.12)->setGroup(321)->setExportOrder(4321)->setFid(654),
            (new Status())->setCode(211)->setStatus('ras'),
            (new DayDate())->setDayDate('2011-13-15')
        ]);
        $this->assertEquals(print_r($expected, true), print_r($obj, true));
    }

    function testRefusedListStatusResponse()
    {
        $xml = '<response>
                    <request>status</request>
                    <order id="1013" inner_id="167" price="123.23" customer_price="132.00" incl_deliv_sum="430.12" group="321" export_order="4321" fid="654"/>
                    <status code="211">ras</status>
                    <d_date>2011-13-15</d_date>
                    <refused_items>
                        <item name="some" quantity="2" price="123.23"/>
                        <item name="some2" quantity="2" price="123.23"/>
                    </refused_items>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        $expected = new Response();
        $expected->setItems([
            (new Request())->setRequest('status'),
            (new Order())->setId(1013)->setInnerId(167)->setPrice(123.23)->setCustomerPrice(132.00)->setInclDelivSum(430.12)->setGroup(321)->setExportOrder(4321)->setFid(654),
            (new Status())->setCode(211)->setStatus('ras'),
            (new DayDate())->setDayDate('2011-13-15'),
            (new ItemsRefused())->setItems([
                (new Item())->setName('some')->setQuantity(2)->setPrice(123.23),
                (new Item())->setName('some2')->setQuantity(2)->setPrice(123.23),
            ]),
        ]);
        $this->assertEquals(print_r($expected, true), print_r($obj, true));
    }

    function testDpdListStatusResponse()
    {
        $xml = '<response>
                    <request>status</request>
                    <order id="1013" inner_id="167" price="123.23" customer_price="132.00" incl_deliv_sum="430.12" group="321" export_order="4321" fid="654"/>
                    <status code="211">ras</status>
                    <d_date>2011-13-15</d_date>
                    <poststatus tracking="123" postprice="421.12"/>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        $expected = new Response();
        $expected->setItems([
            (new Request())->setRequest('status'),
            (new Order())->setId(1013)->setInnerId(167)->setPrice(123.23)->setCustomerPrice(132.00)->setInclDelivSum(430.12)->setGroup(321)->setExportOrder(4321)->setFid(654),
            (new Status())->setCode(211)->setStatus('ras'),
            (new DayDate())->setDayDate('2011-13-15'),
            (new PostStatus())->setPostprice(421.12)->setTracking(123)
        ]);
        $this->assertEquals(print_r($expected, true), print_r($obj, true));
    }
    /*function testGetCarryResponse()
    {
        $xml = '<response>
                    <request>carry</request>
                    <carry_list>
                        <office office_code="0" type="PVZ3" office_name="MSK" office_address="some_addr" city_code="0" city_name="some_name" GPS="123.123, 123.123" WorkSchelude="pn,vt,sr" Area="MSK"/>
                        <office office_code="0" type="PVZ" office_name="MSK" office_address="some_addr" city_code="0" city_name="some_name" GPS="123.123, 123.123" WorkSchelude="pn,vt,sr" Area="MSK"/>
                        <office office_code="0" type="PVZ4" office_name="MSK" office_address="some_addr" city_code="0" city_name="some_name" GPS="123.123, 123.123" WorkSchelude="pn,vt,sr" Area="MSK"/>
                    </carry_list>>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        $expected = new Response();
        $expected->setItems([(new Request())->setRequest('carry'),(new ListResponse())->setOffices([
            (new Office())->setOfficeCode(0)->setType('PVZ3')->setOfficeName('MSK')->setOfficeAddress('some_addr')->setCityCode(0)->setCityName('some_name')->setGps('123.123, 123.123')->setWorkSchedule('pn,vt,sr')->setArea('MSK'),
            (new Office())->setOfficeCode(0)->setType('PVZ')->setOfficeName('MSK')->setOfficeAddress('some_addr')->setCityCode(0)->setCityName('some_name')->setGps('123.123, 123.123')->setWorkSchedule('pn,vt,sr')->setArea('MSK'),
            (new Office())->setOfficeCode(0)->setType('PVZ4')->setOfficeName('MSK')->setOfficeAddress('some_addr')->setCityCode(0)->setCityName('some_name')->setGps('123.123, 123.123')->setWorkSchedule('pn,vt,sr')->setArea('MSK'),
            ])
        ]);
        $this->assertEquals(print_r($expected, true), print_r($obj, true));
    }

    function testDpdPickupResponse()
    {
        $xml = '<response>
                    <request>carry</request>
                    <carry_list>
                        <office code="0" type="PVZ3" name="MSK" address="some_addr" city="Voronej" region="MSK"/>
                    </carry_list>>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        $expected = new Response();
        $expected->setItems([(new Request())->setRequest('carry'),(new ListResponse())->setOffices([
            (new Office())->setCode(0)->setType('PVZ3')->setName('MSK')->setAddress('some_addr')->setCity('Voronej')->setRegion('MSK'),
            (new Office())->setCode(0)->setType('PVZ2')->setName('MSK')->setAddress('some_addr')->setCity('Voronej')->setRegion('MSK'),
            (new Office())->setCode(0)->setType('PVZ1')->setName('MSK')->setAddress('some_addr')->setCity('Voronej')->setRegion('MSK'),
        ])
        ]);
        $this->assertEquals(print_r($expected, true), print_r($obj, true));
    }
    */
}
