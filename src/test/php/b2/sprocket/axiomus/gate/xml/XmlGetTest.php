<?php

namespace b2\sprocket\axiomus\gate\xml;

use b2\sprocket\axiomus\adapter\ArraysResponse;
use b2\sprocket\axiomus\adapter\Auth;
use b2\sprocket\axiomus\adapter\CarryList;
use b2\sprocket\axiomus\adapter\City;
use b2\sprocket\axiomus\adapter\DayDate;
use b2\sprocket\axiomus\adapter\Item;
use b2\sprocket\axiomus\adapter\ItemsRefused;
use b2\sprocket\axiomus\adapter\ListResponse;
use b2\sprocket\axiomus\adapter\Office;
use b2\sprocket\axiomus\adapter\Okey;
use b2\sprocket\axiomus\adapter\Order;
use b2\sprocket\axiomus\adapter\PostStatus;
use b2\sprocket\axiomus\adapter\Region;
use b2\sprocket\axiomus\adapter\Request;
use b2\sprocket\axiomus\adapter\Response;
use b2\sprocket\axiomus\adapter\Status;
use b2\sprocket\axiomus\adapter\Version;

require_once __DIR__ . '\..\..\..\test.boot.php';
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\gate\xml\XmlGet.php';

class XmlGetTest extends \PHPUnit_Framework_TestCase {

    private $mapper;
    private $expected;

    protected function setUp()
    {
        $this->mapper = new XmlGet();
        $this->expected = new Response();
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

        $this->expected->setItems([(new Request())->setRequest('new'),(new Auth())->setAuth('asd')->setObjectid(123),(new Status())->setCode(0)->setPrice(123.456)->setStatus('success')]);
        $this->assertEquals(print_r($this->expected, true), print_r($obj, true));
    }

    function testStatusResponse()
    {
        $xml = '<response>
                    <request>status</request>
                    <order id="1013" inner_id="167" price="123.23" customer_price="132.00" incl_deliv_sum="430.12" group="321" export_order="4321" fid="654"/>
                    <status code="211">ras</status>
                    <d_date>2011-13-15</d_date>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        $this->expected->setItems([
            (new Request())->setRequest('status'),
            (new Order())->setId(1013)->setInnerId(167)->setPrice(123.23)->setCustomerPrice(132.00)->setInclDelivSum(430.12)->setGroup(321)->setExportOrder(4321)->setFid(654),
            (new Status())->setCode(211)->setStatus('ras'),
            (new DayDate())->setDayDate('2011-13-15')
        ]);
        $this->assertEquals(print_r($this->expected, true), print_r($obj, true));
    }

    function testRefusedStatusResponse()
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

        
        $this->expected->setItems([
            (new Request())->setRequest('status'),
            (new Order())->setId(1013)->setInnerId(167)->setPrice(123.23)->setCustomerPrice(132.00)->setInclDelivSum(430.12)->setGroup(321)->setExportOrder(4321)->setFid(654),
            (new Status())->setCode(211)->setStatus('ras'),
            (new DayDate())->setDayDate('2011-13-15'),
            (new ArraysResponse())->setItemsRefused([
                (new Item())->setName('some')->setQuantity(2)->setPrice(123.23),
                (new Item())->setName('some2')->setQuantity(2)->setPrice(123.23),
            ]),
        ]);
        $this->assertEquals(print_r($this->expected, true), print_r($obj, true));
    }

    function testDpdStatusResponse()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>status</request>
                    <order id="1013" inner_id="167" price="123.23" customer_price="132.00" incl_deliv_sum="430.12" group="321" export_order="4321" fid="654"/>
                    <status code="211">ras</status>
                    <d_date>2011-13-15</d_date>
                    <poststatus tracking="123" postprice="421.12"/>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        
        $this->expected->setItems([
            (new Request())->setRequest('status'),
            (new Order())->setId(1013)->setInnerId(167)->setPrice(123.23)->setCustomerPrice(132.00)->setInclDelivSum(430.12)->setGroup(321)->setExportOrder(4321)->setFid(654),
            (new Status())->setCode(211)->setStatus('ras'),
            (new DayDate())->setDayDate('2011-13-15'),
            (new PostStatus())->setPostprice(421.12)->setTracking(123)
        ]);
        $this->assertEquals(print_r($this->expected, true), print_r($obj, true));
    }

    function testListStatusResponse()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>status_list</request>
                    <okeylist>
                        <okey id="123" status_code="100" status_name="ok" inner_id="Zak #123" price="123.45" customer_price="54.321">asd123</okey>
                        <okey id="123" status_code="105" status_name="ok" inner_id="Zak #123" price="123.45" customer_price="54.321">asd123</okey>
                    </okeylist>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        
        $this->expected->setItems([
            (new Request())->setRequest('status_list'),
            (new ArraysResponse())->setOkeylist([
                (new Okey())->setId(123)->setStatusCode(100)->setStatusName('ok')->setInnerId('Zak #123')->setPrice(123.45)->setCustomerPrice(54.321)->setOkey('asd123'),
                (new Okey())->setId(123)->setStatusCode(105)->setStatusName('ok')->setInnerId('Zak #123')->setPrice(123.45)->setCustomerPrice(54.321)->setOkey('asd123'),
            ]),
        ]);
        $this->assertEquals(print_r($this->expected, true), print_r($obj, true));
    }
    function testGetCarryResponse()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>carry</request>
                    <carry_list>
                        <office office_code="0" type="PVZ3" office_name="MSK" office_address="some_addr" city_code="0" city_name="some_name" GPS="123.123, 123.123" WorkSchedule="pn,vt,sr" Area="MSK"/>
                        <office office_code="0" type="PVZ" office_name="MSK" office_address="some_addr" city_code="0" city_name="some_name" GPS="123.123, 123.123" WorkSchedule="pn,vt,sr" Area="MSK"/>
                        <office office_code="0" type="PVZ4" office_name="MSK" office_address="some_addr" city_code="0" city_name="some_name" GPS="123.123, 123.123" WorkSchedule="pn,vt,sr" Area="MSK"/>
                    </carry_list>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        
        $this->expected->setItems([(new Request())->setRequest('carry'),(new ArraysResponse())->setCarryList([
            (new Office())->setOfficeCode(0)->setType('PVZ3')->setOfficeName('MSK')->setOfficeAddress('some_addr')->setCityCode(0)->setCityName('some_name')->setGps('123.123, 123.123')->setWorkSchedule('pn,vt,sr')->setArea('MSK'),
            (new Office())->setOfficeCode(0)->setType('PVZ')->setOfficeName('MSK')->setOfficeAddress('some_addr')->setCityCode(0)->setCityName('some_name')->setGps('123.123, 123.123')->setWorkSchedule('pn,vt,sr')->setArea('MSK'),
            (new Office())->setOfficeCode(0)->setType('PVZ4')->setOfficeName('MSK')->setOfficeAddress('some_addr')->setCityCode(0)->setCityName('some_name')->setGps('123.123, 123.123')->setWorkSchedule('pn,vt,sr')->setArea('MSK'),
            ])
        ]);
        $this->assertEquals(print_r($this->expected, true), print_r($obj, true));
    }

    function testDpdPickupResponse()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>carry</request>
                    <pickup_list>
                        <office code="0" type="PVZ3" name="MSK" address="some_addr" city="Voronej" region="MSK"/>
                        <office code="0" type="PVZ2" name="MSK" address="some_addr" city="Voronej" region="MSK"/>
                    </pickup_list>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        
        $this->expected->setItems([(new Request())->setRequest('carry'),(new ArraysResponse())->setPickupList([
            (new Office())->setCode(0)->setType('PVZ3')->setName('MSK')->setAddress('some_addr')->setCity('Voronej')->setRegion('MSK'),
            (new Office())->setCode(0)->setType('PVZ2')->setName('MSK')->setAddress('some_addr')->setCity('Voronej')->setRegion('MSK'),
        ])
        ]);
        $this->assertEquals(print_r($this->expected, true), print_r($obj, true));
    }

    function testRegionsResponse()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>regions</request>
                    <region region_code="46" name="Alt">
                        <courier>
                            <city city_code="20">Barnaul</city>
                            <city city_code="22">NeBarnaul</city>
                        </courier>
                        <pickup>
                            <office office_code="32" city_code="20">ul 1</office>
                            <office office_code="33" city_code="22">ul 3</office>
                        </pickup>
                    </region>
                    <region region_code="47" name="neAlt">
                        <courier>
                            <city city_code="20">Barnaul</city>
                            <city city_code="22">NeBarnaul</city>
                        </courier>
                        <pickup>
                            <office office_code="32" city_code="20">ul 1</office>
                            <office office_code="33" city_code="22">ul 3</office>
                        </pickup>
                    </region>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        
        $this->expected->setItems([(new Request())->setRequest('regions'),
            (new Region())->setRegionCode(46)->setName('Alt')
                ->setCourier([
                    (new City())->setCity('Barnaul')->setCityCode(20),
                    (new City())->setCity('NeBarnaul')->setCityCode(22),
                ])->setPickup([
                    (new Office())->setOfficeCode(32)->setCityCode(20)->setOffice('ul 1'),
                    (new Office())->setOfficeCode(33)->setCityCode(22)->setOffice('ul 3'),
                ]),
            (new Region())->setRegionCode(47)->setName('neAlt')
                ->setCourier([
                    (new City())->setCity('Barnaul')->setCityCode(20),
                    (new City())->setCity('NeBarnaul')->setCityCode(22),
                ])->setPickup([
                    (new Office())->setOfficeCode(32)->setCityCode(20)->setOffice('ul 1'),
                    (new Office())->setOfficeCode(33)->setCityCode(22)->setOffice('ul 3'),
                ]),
        ]);
        $this->assertEquals(print_r($this->expected, true), print_r($obj, true));
    }

    function testBoxBerryGeographyRespose()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>boxberry_pickup</request>
                    <pickup_list>
                        <office office_code="191" office_name="Абакан" office_address="some address" city_code="5" city_name="Абакан" GPS="53.123,91.123" Area="some area" WorkSchedule="some time"/>
                        <office office_code="291" office_name="neАбакан" office_address="ne some address" city_code="52" city_name="neАбакан" GPS="53.123,91.123" Area="some area" WorkSchedule="some time"/>
                    </pickup_list>
                </response>
                ';
        $obj = $this->mapper->map($xml);

        
        $this->expected->setItems([(new Request())->setRequest('boxberry_pickup'),(new ArraysResponse())->setPickupList([
            (new Office())->setOfficeCode(191)->setOfficeName('Абакан')->setOfficeAddress('some address')->setCityCode(5)->setCityName('Абакан')->setGps('53.123,91.123')->setWorkSchedule('some time')->setArea('some area'),
            (new Office())->setOfficeCode(291)->setOfficeName('neАбакан')->setOfficeAddress('ne some address')->setCityCode(52)->setCityName('neАбакан')->setGps('53.123,91.123')->setWorkSchedule('some time')->setArea('some area'),
            ])
        ]);
        $this->assertEquals(print_r($this->expected, true), print_r($obj, true));
    }

    function testGetPriceResponse()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>get_price</request>
                    <order total_price="123.45" agent_price="54.321" subagent_price="56.789"/>
                </response>';
        $obj = $this->mapper->map($xml);

        $this->expected->setItems([
            (new Request())->setRequest('get_price'),
            (new Order())->setTotalPrice(123.45)->setAgentPrice(54.321)->setSubagentPrice(56.789)
        ]);
        $this->assertEquals(print_r($this->expected, true), print_r($obj, true));
    }

    function testDeleteResponse()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>delete</request>
                    <order id="12345"/>
                </response>';
        $obj = $this->mapper->map($xml);

        $this->expected->setItems([
            (new Request())->setRequest('delete'),
            (new Order())->setId(12345),
        ]);
        $this->assertEquals(print_r($this->expected, true), print_r($obj, true));
    }

    function testVersionResponse()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>get_price</request>
                    <version>2.14</version>
                </response>';
        $obj = $this->mapper->map($xml);

        $this->expected->setItems([
            (new Request())->setRequest('get_price'),
            (new Version())->setVersion(2.14)
        ]);
        $this->assertEquals(print_r($this->expected, true), print_r($obj, true));
    }
}
