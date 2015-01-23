<?php

namespace b2\sprocket\axiomus\gate;

use b2\sprocket\axiomus\api\ApplicationResponse;
use b2\sprocket\axiomus\api\AuthResponse;
use b2\sprocket\axiomus\api\City;
use b2\sprocket\axiomus\api\GetListResponse;
use b2\sprocket\axiomus\api\Office;
use b2\sprocket\axiomus\api\Okey;
use b2\sprocket\axiomus\api\OrderResponse;
use b2\sprocket\axiomus\api\Region;
use b2\sprocket\axiomus\api\Status;

require_once __DIR__ . '\..\..\test.boot.php';
require_once 'C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus\gate\XmlGet.php';

class XmlGetTest extends \PHPUnit_Framework_TestCase
{

    private $mapper;

    protected function setUp()
    {
        $this->mapper = new XmlGet();
    }

    function testNewOrderResponse()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>new</request>
                    <auth objectid="123">asd</auth>
                    <status price="123.456" code="0">success</status>
                </response>';

        $expected = new ApplicationResponse();
        $expected->setAuth((new AuthResponse())->setObjectid(123)->setAuth('asd'))->setStatus((new Status())->setStatus('success')->setCode(0)->setPrice(123.456));
        $this->check($xml, $expected);
    }

    function testGetCarryDpdBoxberry_Carry()
    {
        $xml = '<response>
                    <request>carry</request>
                    <carry_list>
                        <office office_code="0" type="ПВЗ" office_name="Мск ПВЗ-1 Тимирязевская" office_address="127254, Москва, Огородный пр., д.20, стр.38"
                            city_code="0" city_name="Москва" GPS="55.819196, 37.594153" WorkSchedule="Пн,Вт,Ср,Чт,Пт,Сб [10:30 - 20:00];Вс [выходной]" Area="Москва" />
                        <office office_code="203" type="ПВЗ" office_name="Мск ПВЗ-3 Пушкинская" office_address="127006, Москва, Настасьинский пер., д.4, стр.2, офис 214"
                            city_code="0" city_name="Москва" GPS="55.766947, 37.604807" WorkSchedule="Пн,Вт,Ср,Чт,Пт [10:00 - 20:00];Сб,Вс [выходной]" Area="Москва" />
                    </carry_list>
                </response>';
        $expected = new GetListResponse();
        $expected->setList([
            (new Office())->setOfficeCode(0)->setType('ПВЗ')->setOfficeName('Мск ПВЗ-1 Тимирязевская')->setOfficeAddress('127254, Москва, Огородный пр., д.20, стр.38')->setCityCode(0)->setCityName('Москва')
                ->setGps('55.819196, 37.594153')->setWorkSchedule('Пн,Вт,Ср,Чт,Пт,Сб [10:30 - 20:00];Вс [выходной]')->setArea('Москва'),
            (new Office())->setOfficeCode(203)->setType('ПВЗ')->setOfficeName('Мск ПВЗ-3 Пушкинская')->setOfficeAddress('127006, Москва, Настасьинский пер., д.4, стр.2, офис 214')->setCityCode(0)
                ->setCityName('Москва')->setGps('55.766947, 37.604807')->setWorkSchedule('Пн,Вт,Ср,Чт,Пт [10:00 - 20:00];Сб,Вс [выходной]')->setArea('Москва')
        ]);
        $this->check($xml, $expected);
    }

    function testGetCarryDpdBoxberry_DpdORBoxberry()
    {
        $xml = '<response>
                    <request>dpd_pickup</request>
                    <pickup_list>
                        <office code="11A" type="ПВЗ" name="Воронеж" address="394006, Воронежская обл., г. Воронеж, ул. Свободы, д. 73" region="Воронежская" city="Воронеж" />
                        <office code="BAX" type="Терминал" name="Барнаул - терминал" address="656922, Алтайский край, г. Барнаул, ул. Попова, д. 244" region="Алтайский" city="Барнаул" />
                    </pickup_list>
                </response>';
        $expected = new GetListResponse();
        $expected->setList([
            (new Office())->setCode('11A')->setType('ПВЗ')->setName('Воронеж')->setAddress('394006, Воронежская обл., г. Воронеж, ул. Свободы, д. 73')->setRegion('Воронежская')->setCity('Воронеж'),
            (new Office())->setCode('BAX')->setType('Терминал')->setName('Барнаул - терминал')->setAddress('656922, Алтайский край, г. Барнаул, ул. Попова, д. 244')->setRegion('Алтайский')->setCity('Барнаул')
        ]);
        $this->check($xml, $expected);
    }

    function testGetRegions()
    {
        $xml = '
            <response>
            <request>regions</request>
            <region region_code="46" name="Алтайский край">
                <courier>
                    <city city_code="220">Барнаул</city>
                    <city city_code="222">Бийск</city>
                    <city city_code="224">Рубцовск</city>
                </courier>
                <pickup>
                    <office office_code="32" city_code="220">ул. Чкалова д.70</office>
                </pickup>
            </region>
            <region region_code="47" name="Алтайский край">
                <courier>
                    <city city_code="2201">Барнаул</city>
                    <city city_code="2221">Бийсклл</city>
                    <city city_code="2241">Рубцовск</city>
                </courier>
                <pickup>
                    <office office_code="323" city_code="220">ул. Чкалова д.70</office>
                </pickup>
            </region>
            </response>';

        $expected = new GetListResponse();
        $expected->setList([
            (new Region())->setRegionCode(46)->setName('Алтайский край')->setCourier([
                (new City())->setCityCode(220)->setCity('Барнаул'),
                (new City())->setCityCode(222)->setCity('Бийск'),
                (new City())->setCityCode(224)->setCity('Рубцовск'),
            ])->setPickup([
                (new Office())->setOfficeCode(32)->setCityCode(220)->setOffice('ул. Чкалова д.70')
            ]),
            (new Region())->setRegionCode(47)->setName('Алтайский край')->setCourier([
                (new City())->setCityCode(2201)->setCity('Барнаул'),
                (new City())->setCityCode(2221)->setCity('Бийсклл'),
                (new City())->setCityCode(2241)->setCity('Рубцовск'),
            ])->setPickup([
                (new Office())->setOfficeCode(323)->setCityCode(220)->setOffice('ул. Чкалова д.70')
            ]),
        ]);
        $this->check($xml, $expected);
    }

    function testApplicationStatus()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>status</request>
                    <order id="1013" inner_id="16777" price="156.83" customer_price="1430.00" incl_deliv_sum="430.00" group="317" export_order="1179925" fid="61257" />
                    <status code="211">расчет за доставку</status>
                    <d_date>2011-03-17</d_date>
                </response>';
        $expected = new ApplicationResponse();
        $expected->setStatus((new Status())->setCode(211)->setStatus('расчет за доставку'))->setDayDate('2011-03-17')
            ->setOrder((new OrderResponse())->setId(1013)->setInnerId(16777)->setPrice(156.83)->setCustomerPrice(1430.00)->setInclDelivSum(430.00)->setGroup(317)->setExportOrder(1179925)->setFid(61257));
        $this->check($xml, $expected);
    }

    function testApplicationStatusList()
    {
        $xml = '<?xml version="1.0" encoding="utf-8" ?>
                <response>
                    <request>status_list</request>
                    <okeylist>
                        <okey id="1180901" status_code="100" status_name="выполнен" inner_id="Заказ #878" price="406.02" customer_price="430.00">7bbf66349060b723bba20ef687ee4ebf</okey>
                        <okey id="1991064" status_code="100" status_name="выполнен" inner_id="" price="0.00" customer_price="">f2c2635a00310d39cf26b7cc1db6fab2</okey>
                    </okeylist>
                </response>';
        $expected = new GetListResponse();
        $expected->setList([
            (new Okey())->setId(1180901)->setStatusCode(100)->setStatusName('выполнен')->setInnerId('Заказ #878')->setPrice(406.02)->setCustomerPrice(430.00)->setOkey('7bbf66349060b723bba20ef687ee4ebf'),
            (new Okey())->setId(1991064)->setStatusCode(100)->setStatusName('выполнен')->setInnerId('')->setPrice(0.00)->setCustomerPrice(0)->setOkey('f2c2635a00310d39cf26b7cc1db6fab2'),
        ]);
        $this->check($xml, $expected);
    }

    function testGetPrice()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>get_price</request>
                    <order total_price="426.91" agent_price="80" subagent_price="346.91"/>
                </response>';
        $expected = new ApplicationResponse();
        $expected->setOrder((new OrderResponse())->setTotalPrice(426.91)->setAgentPrice(80)->setSubagentPrice(346.91));
        $this->check($xml, $expected);
    }

    function testDeleteResponse()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <response>
                    <request>delete</request>
                    <order id="2379191" />
                </response>';
        $expected = new ApplicationResponse();
        $expected->setOrder((new OrderResponse())->setId(2379191));
        $this->check($xml, $expected);
    }

    function testVersion()
    {
        $xml = '<?xml version="1.0" encoding="utf-8" ?>
                <response>
                    <request>get_version</request>
                    <version>2.25</version>
                </response>';
        $expected = new ApplicationResponse();
        $expected->setVersion(2.25);
        $this->check($xml, $expected);
    }
    private function check($xml, $expected)
    {
        $this->assertEquals(print_r($expected, true), print_r($this->mapper->responseMap($xml), true));
    }
}
