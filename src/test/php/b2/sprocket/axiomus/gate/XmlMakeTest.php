<?php

namespace b2\sprocket\axiomus\gate;

use b2\sprocket\axiomus\api\AuthRequest;
use b2\sprocket\axiomus\api\CarryOrder;
use b2\sprocket\axiomus\api\DpdOrder;
use b2\sprocket\axiomus\api\Mode;
use b2\sprocket\axiomus\api\NewOrder;
use b2\sprocket\axiomus\api\OrderAddress;
use b2\sprocket\axiomus\api\DelivsetBelow;
use b2\sprocket\axiomus\api\OrderDelivset;
use b2\sprocket\axiomus\api\PostOrder;
use b2\sprocket\axiomus\api\RegionCourierOrder;
use \b2\sprocket\axiomus\api\SingleOrderRequest;
use b2\sprocket\axiomus\api\OrderContent;
use b2\sprocket\axiomus\api\BoxberryServices;
use b2\sprocket\axiomus\api\ExportServices;
use b2\sprocket\axiomus\api\OrderServices;
use b2\sprocket\axiomus\api\RegionServices;
use b2\sprocket\axiomus\api\ExportOrder;
use b2\sprocket\axiomus\api\OrderItem;
use b2\sprocket\axiomus\api\SelfExportOrder;

define('B2_FOUNDATION_TEMPLATES','C:\Work\Axiomus\foundation\src\main\php\b2\templates');
define('B2_AXIOMUS_TEMPLATES','C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus');
define('XML_HEADER', '<?xml version="1.0" standalone="yes"?>');

require_once B2_AXIOMUS_TEMPLATES . '\gate\XmlMake.php';
require_once __DIR__ . '\..\..\test.boot.php';


class XmlMakeTest extends \PHPUnit_Framework_TestCase {

    private $xml;

    protected function setUp()
    {
        $this->xml = new XmlMake();
    }

    function testSingleOrderStatusRequest_objects()
    {
        $status = new SingleOrderRequest();

        $status->setMode('status')->setOkey('23fs2fsd3');
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<singleorder><mode>status</mode><okey>23fs2fsd3</okey></singleorder>',
            $this->xml->makeXml($status)
        );
    }

    function testSingleOrderGeographyRequest()
    {

        $geography = new SingleOrderRequest();
        $geography->setAuth('123asd')->setMode('get_dpd_pickup');

        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<singleorder><mode>get_dpd_pickup</mode><auth ukey="123asd"/></singleorder>',
            $this->xml->makeXml($geography)
        );
    }

    function testSingleOrderCarryStatus_MskStP()
    {
        $status = new SingleOrderRequest();

        $status->setMode('get_carry')->setAuth('123qwe');

        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<singleorder><mode>get_carry</mode><auth ukey="123qwe"/></singleorder>',
            $this->xml->makeXml($status)
        );
    }

    function testSingleOrderCarryStatus_DPD()
    {
        $status = new SingleOrderRequest();

        $status->setMode('get_dpd_pickup')->setAuth('321ewq');

        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<singleorder><mode>get_dpd_pickup</mode><auth ukey="321ewq"/></singleorder>',
            $this->xml->makeXml($status)
        );
    }

    function testSingleOrderStatusListRequest()
    {
        $statusList = new SingleOrderRequest();

        $statusList->setMode('status_list')->setOkeylist([1,2,3]);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<singleorder><mode>status_list</mode><okeylist><okey>1</okey><okey>2</okey><okey>3</okey></okeylist></singleorder>',
            $this->xml->makeXml($statusList)
        );
    }

    function testSingleOrderDeliveryRequest_Arrays()
    {
        $delivery = new SingleOrderRequest();
        $auth = new AuthRequest();

        $delivset = [
            'returnPrice' => 20.00,
            'abovePrice' => 50.00,
            'belows' => [
                [
                    'belowSum' => 100.00,
                    'price' => 250.00
                ],
                [
                    'belowSum' => 500.00,
                    'price' => 150.00
                ]
            ]
        ];
        $services = ['cash' => true, 'cheque' => false];
        $items = [
            [
                'name' => 'товар 1',
                'weight' => 2.000,
                'quantity' => 3,
                'price' => 340.55
            ],
            [
                'name' => 'товар 2',
                'weight' => 3.000,
                'quantity' => 5,
                'price' => 555.55
            ]
        ];
        $orderContent = [
            'contacts' => 'тел. 8905',
            'description' => 'сзади',
            'services' => $services,
            'items' => $items,
            'delivset' => $delivset
        ];
        $order = (new NewOrder())->setInnerId(123)->setName('Кл')->setAddress('Москва...')->setFromMkad(0)->setDayDate('2009-12-14')->setBeginTime('12:00')->setEndTime('13:00')->setPlaces(1)->setCity(0)
            ->setSms(8905)->setOrderContent($orderContent);
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new</mode>
                <auth ukey="321ewq" checksum="123qwe"/>
                <order inner_id="123" name="Кл" address="Москва..." from_mkad="0" d_date="2009-12-14" b_time="12:00" e_time="13:00" places="1" city="0" sms="8905">
                    <contacts>тел. 8905</contacts>
                    <description>сзади</description>
                    <services cash="yes" cheque="no" />
                    <items>
                        <item name="товар 1" weight="2" quantity="3" price="340.55"/>
                        <item name="товар 2" weight="3" quantity="5" price="555.55"/>
                    </items>
                    <delivset return_price="20" above_price="50">
                        <below below_sum="100" price="250" />
                        <below below_sum="500" price="150" />
                    </delivset>
                </order>
            </singleorder>',
            $this->xml->makeXml($delivery)
        );
    }

    function testSingleOrderDeliveryRequest_Objects()
    {
        $belows = new DelivsetBelow();
        $belows->setBelowSum(100.00)->setPrice(250.00);

        $delivset = new OrderDelivset();
        $delivset->setAbovePrice(50.00)->setReturnPrice(20.00)->setBelows($belows);

        $item = new OrderItem();
        $item->setPrice(340.55)->setName('товар 1')->setQuantity(3)->setWeight(2);

        $services = new OrderServices();
        $services->setCash(true);

        $orderContent = new OrderContent();
        $orderContent->setItems([$item->asArray()])->setDelivset($delivset)->setServices($services)->setContacts('тел. 8905')->setDescription('сзади');

        $order = new NewOrder();
        $order->setOrderContent($orderContent)->setAddress('Москва...')->setBeginTime('12:00')->setCity(0)->setDayDate('2009-12-14')->setEmail('mail@ru')->setEndTime('13:00')
            ->setSms(8905)->setName('Кл')->setInnerId('123')->setPlaces(1);

        $mode = new Mode();
        $mode->setOrderType('new');

        $auth = new AuthRequest();
        $auth->setUkey('321ewq')->setCheckSum('123qwe');

        $delivery = new SingleOrderRequest();
        $delivery->setAuth($auth)->setMode($mode)->setOrder($order);

        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new</mode>
                <auth ukey="321ewq" checksum="123qwe"/>
                <order inner_id="123" name="Кл" address="Москва..." d_date="2009-12-14" places="1" b_time="12:00" e_time="13:00" city="0" sms="8905" email="mail@ru">
                    <contacts>тел. 8905</contacts>
                    <description>сзади</description>
                    <services cash="yes" />
                    <items>
                        <item name="товар 1" weight="2.000" quantity="3" price="340.55"/>
                    </items>
                    <delivset return_price="20.000" above_price="50.000">
                        <below below_sum="100.000" price="250.000" />
                    </delivset>
                </order>
            </singleorder>',
            $this->xml->makeXml($delivery)
        );
    }

    function testSingleOrderDeliveryRequest_WithioutDelivset()
    {
        $delivery = new SingleOrderRequest();
        $auth = new AuthRequest();

        $services = ['cash' => true, 'cheque' => false];
        $items = [
            [
                'name' => 'товар 1',
                'weight' => 2.000,
                'quantity' => 3,
                'price' => 340.55
            ],
            [
                'name' => 'товар 2',
                'weight' => 3.000,
                'quantity' => 5,
                'price' => 555.55
            ]
        ];
        $orderContent = [
            'contacts' => 'тел. 8905',
            'description' => 'сзади',
            'services' => $services,
            'items' => $items
        ];
        $order = (new NewOrder())->setInnerId(123)->setName('Кл')->setAddress('Москва...')->setFromMkad(0)->setDayDate('2009-12-14')->setBeginTime('12:00')->setEndTime('13:00')->setPlaces(1)->setCity(0)
            ->setSms(8905)->setOrderContent($orderContent);
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new</mode>
                <auth ukey="321ewq" checksum="123qwe"/>
                <order inner_id="123" name="Кл" address="Москва..." from_mkad="0" d_date="2009-12-14" b_time="12:00" e_time="13:00" places="1" city="0" sms="8905">
                    <contacts>тел. 8905</contacts>
                    <description>сзади</description>
                    <services cash="yes" cheque="no" />
                    <items>
                        <item name="товар 1" weight="2" quantity="3" price="340.55"/>
                        <item name="товар 2" weight="3" quantity="5" price="555.55"/>
                    </items>
                </order>
            </singleorder>',
            $this->xml->makeXml($delivery)
        );
    }

    function testSingleOrderDeliveryRequest_MinOrder()
    {
        $delivery = new SingleOrderRequest();
        $auth = new AuthRequest();

        $items = [[
            'name' => 'товар 1',
            'weight' => 2.000,
            'quantity' => 3,
            'price' => 340.55
        ]];
        $orderContent = [
            'contacts' => 'тел. 8905',
            'items' => $items
        ];
        $order = (new NewOrder())->setName('Кл')->setAddress('Москва...')->setDayDate('2009-12-14')->setBeginTime('12:00')->setEndTime('13:00')->setPlaces(1)->setCity(0)->setOrderContent($orderContent);
        /*$order = [
            'order' => [
                'name' => 'Кл',
                'address' => 'Москва...',
                'dayDate' => '2009-12-14',
                'beginTime' => '12:00',
                'endTime' => '13:00',
                'places' => '1',
                'city' => '0',
                'orderContent' => $orderContent
            ]
        ];*/
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new</mode>
                <auth ukey="321ewq" checksum="123qwe"/>
                <order name="Кл" address="Москва..." d_date="2009-12-14" b_time="12:00" e_time="13:00" places="1" city="0">
                    <contacts>тел. 8905</contacts>
                    <items>
                        <item name="товар 1" weight="2" quantity="3" price="340.55"/>
                    </items>
                </order>
            </singleorder>',
            $this->xml->makeXml($delivery)
        );
    }

    function testSingleOrderDeliveryRequest_MinWithDiscount()
    {
        $delivery = new SingleOrderRequest();
        $auth = new AuthRequest();

        $items = [[
            'name' => 'товар 1',
            'weight' => 2.000,
            'quantity' => 3,
            'price' => 340.55
        ]];
        $discountset = [
            'aboveDiscount' => 15.00,
            'belows' => [
                [
                    'belowSum' => 1000.00,
                    'discount' => 0.00
                ],
                [
                    'belowSum' => 3000.50,
                    'discount' => 5.00
                ]
            ]
        ];
        $orderContent = [
            'contacts' => 'тел. 8905',
            'items' => $items,
            'discountset' => $discountset
        ];
        $order = (new NewOrder())->setName('Кл')->setAddress('Москва...')->setDayDate('2009-12-14')->setBeginTime('12:00')->setEndTime('13:00')->setPlaces(1)->setCity(0)->setOrderContent($orderContent);

        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new</mode>
                <auth ukey="321ewq" checksum="123qwe"/>
                <order name="Кл" address="Москва..." d_date="2009-12-14" b_time="12:00" e_time="13:00" places="1" city="0">
                    <contacts>тел. 8905</contacts>
                    <items>
                        <item name="товар 1" weight="2" quantity="3" price="340.55"/>
                    </items>
                    <discountset  above_discount="15">
                        <below  below_sum="1000" discount="0"/>
                        <below  below_sum="3000.5" discount="5"/>
                    </discountset>
                </order>
            </singleorder>',
            $this->xml->makeXml($delivery)
        );
    }

    function testSingleOrderPostRequest()
    {
        $delivery = new SingleOrderRequest();
        $auth = new AuthRequest();

        $services = [
            'valuation' => true,
            'fragile' => false,
            'cod' => false
        ];
        $items = [
            [
                'name' => 'товар 1',
                'weight' => 2.000,
                'quantity' => 3,
                'price' => 340.55
            ],
            [
                'name' => 'товар 2',
                'weight' => 3.000,
                'quantity' => 5,
                'price' => 555.55
            ]
        ];
        $address = [
            'index' => '321123',
            'region' => 'Камчатский край',
            'area' => 'Москва',
            'poluchAddress' => 'ул. Блабла, д.3, кв.20'
        ];
        $orderContent = [
            'contacts' => 'тел. 8905',
            'services' => $services,
            'address' => $address,
            'items' => $items
        ];
        $order = (new PostOrder())->setInnerId(123)->setOkey('qwe123')->setName('Кл')->setBeginDate('2009-12-14')->setSms(8905)->setPostType(0)->setOrderContent($orderContent);
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new_post')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new_post</mode>
                <auth ukey="321ewq" checksum="123qwe"/>
                <order okey="qwe123" inner_id="123" name="Кл" b_date="2009-12-14" sms="8905" post_type="0">
                    <address index="321123" region="Камчатский край" area="Москва" p_address="ул. Блабла, д.3, кв.20" />
                    <contacts>тел. 8905</contacts>
                    <services  valuation="yes" fragile="no" cod="no"  />
                    <items>
                        <item name="товар 1" weight="2" quantity="3" price="340.55"/>
                        <item name="товар 2" weight="3" quantity="5" price="555.55"/>
                    </items>
                </order>
            </singleorder>',
            $this->xml->makeXml($delivery)
        );
    }

    function testSingleOrderPostRequest_OneArray()
    {
        $delivery = new SingleOrderRequest();
        $auth = new AuthRequest();

        $order = (new PostOrder())->setInnerId(123)->setOkey('qwe123')->setName('Кл')->setBeginDate('2009-12-14')->setSms(8905)->setPostType(0)->setOrderContent(
            [
                'contacts' => 'тел. 8905',
                'services' => [
                    'valuation' => true,
                    'fragile' => false,
                    'cod' => true,
                    'big' => true,
                    'class1' => true,
                    'postTarif' => false,
                    'notAvia' => true,
                    'optimize' => false,
                    'smsInform' => true,
                    'insurance' => false
                ],
                'address' => [
                    'index' => '321123',
                    'region' => 'Камчатский край',
                    'area' => 'Москва',
                    'poluchAddress' => 'ул. Блабла, д.3, кв.20'
                ],
                'items' => [
                    [
                        'name' => 'товар 1',
                        'weight' => 2.000,
                        'quantity' => 3,
                        'price' => 340.55
                    ],
                    [
                        'name' => 'товар 2',
                        'weight' => 3.000,
                        'quantity' => 5,
                        'price' => 555.55
                    ]
                ]
            ]
        );

        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new_post')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new_post</mode>
                <auth ukey="321ewq" checksum="123qwe"/>
                <order okey="qwe123" inner_id="123" name="Кл" b_date="2009-12-14" sms="8905" post_type="0">
                    <address index="321123" region="Камчатский край" area="Москва" p_address="ул. Блабла, д.3, кв.20" />
                    <contacts>тел. 8905</contacts>
                    <services valuation="yes" fragile="no" cod="yes" big="yes" class1="yes" post_tarif="no" not_avia="yes" oprimize="no" sms_inform="yes" insurance="no" />
                    <items>
                        <item name="товар 1" weight="2" quantity="3" price="340.55"/>
                        <item name="товар 2" weight="3" quantity="5" price="555.55"/>
                    </items>
                </order>
            </singleorder>',
            $this->xml->makeXml($delivery)
        );
    }

    function testSingleOrderDpdRequest()
    {
        $delivery = new SingleOrderRequest();
        $auth = new AuthRequest();

        $services = [
            'valuation' => true,
            'fragile' => false,
            'waiting' => true,
            'cod' => false
        ];
        $items = [
            [
                'name' => 'товар 1',
                'weight' => 2.000,
                'quantity' => 3,
                'price' => 340.55
            ],
            [
                'name' => 'товар 2',
                'weight' => 3.000,
                'quantity' => 5,
                'price' => 555.55
            ]
        ];
        $address = [
            'index' => '321123',
            'region' => 'Камчатский край',
            'area' => 'Москва',
            'street' => 'Литейная',
            'house' => '12а',
            'carrymode' => '10А'
        ];
        $orderContent = [
            'contacts' => 'тел. 8905',
            'services' => $services,
            'address' => $address,
            'items' => $items
        ];
        $order = (new DpdOrder())->setInnerId(123)->setOkey('qwe123')->setName('Кл')->setEndTime('12:00')->setBeginTime('11:00')->setBeginDate('2009-12-14')->setPostType(0)->setOrderContent($orderContent);
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new_dpd')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new_dpd</mode>
                <auth ukey="321ewq" checksum="123qwe"/>
                <order okey="qwe123" inner_id="123" name="Кл" b_date="2009-12-14" e_time="12:00" b_time="11:00" post_type="0">
                    <address index="321123" region="Камчатский край" area="Москва" street="Литейная" house="12а" carrymode="10А" />
                    <contacts>тел. 8905</contacts>
                    <services  valuation="yes" fragile="no" cod="no" waiting="yes" />
                    <items>
                        <item name="товар 1" weight="2" quantity="3" price="340.55"/>
                        <item name="товар 2" weight="3" quantity="5" price="555.55"/>
                    </items>
                </order>
            </singleorder>',
            $this->xml->makeXml($delivery)
        );
    }

    function testSingleOrderCarryRequest_withNotNecessaryData()
    {
        $delivery = new SingleOrderRequest();
        $auth = new AuthRequest();

        $delivset = [
            'returnPrice' => 20,
            'abovePrice' => 50,
            'belows' => [
                [
                    'belowSum' => 100,
                    'price' => 250
                ],
                [
                    'belowSum' => 500,
                    'price' => 150.5
                ]
            ]
        ];
        $services = [
            'cash' => true,
            'cheque' => false,
            'big' => true
        ];
        $items = [
            [
                'name' => 'товар 1',
                'weight' => 2.000,
                'quantity' => 3,
                'price' => 340.55,
                'expmode' => 1
            ],
            [
                'name' => 'товар 2',
                'weight' => 3.000,
                'quantity' => 5,
                'price' => 555.55
            ]
        ];
        $orderContent = [
            'contacts' => 'тел. 8905',
            'description' => 'сзади',
            'services' => $services,
            'items' => $items,
            'delivset' => $delivset
        ];
        $order = (new CarryOrder())->setInnerId('самовыв. 111')->setName('Петр')->setOffice(0)->setBeginDate('2011-03-10')->setEndDate('2011-03-15')->setInclDelivSum(200.15)->setPlaces(1)->setSms(79037902225)
            ->setDiscountValue('auto')->setDiscountUnit(1)->setOrderContent($orderContent);
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new_carry')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new_carry</mode>
                <auth ukey="321ewq" checksum="123qwe"/>
                <order inner_id="самовыв. 111" name="Петр" office="0" b_date="2011-03-10" e_date="2011-03-15" incl_deliv_sum="200.15" places="1" sms="79037902225" discount_value="auto" discount_unit="1">
                    <contacts>тел. 8905</contacts>
                    <description>сзади</description>
                    <services cash="yes" cheque="no" big="yes"/>
                    <items>
                        <item name="товар 1" weight="2" quantity="3" price="340.55" expmode="1"/>
                        <item name="товар 2" weight="3" quantity="5" price="555.55"/>
                    </items>
                    <delivset return_price="20" above_price="50">
                        <below below_sum="100" price="250" />
                        <below below_sum="500" price="150.5" />
                    </delivset>
                </order>
            </singleorder>',
            $this->xml->makeXml($delivery)
        );
    }

    function testSingleOrderNewExportRequest()
    {
        $newCarry = new SingleOrderRequest();
        $auth = new AuthRequest();
        $auth->setUkey('asd123')->setCheckSum('123asd');
        $mode = new Mode();
        $mode->setOrderType('new_export');



        $item = new OrderItem();
        $item->setName('крем')->setWeight(0.4)->setQuantity(2)->setPrice(123.55);
        $items = [ $item->asArray(), $item->asArray(), $item->asArray()];

        $orderContent = new OrderContent();
        $orderContent->setContacts('Иван, тел 89876')->setDescription('propusk')->setServices((new ExportServices())->setWarrant(false))->setItems($items);


        $order = new ExportOrder();
        $order->setName('Петр')->setAddress('some Address')->setFromMkad(0)->setDayDate('2010-11-25')->setBeginTime('12:00')->setEndTime('13:00')->setExportQuantity(3)->setTransit(false)->setOrderContent($orderContent);

        $newCarry->setAuth($auth)->setMode($mode)->setOrder($order);

        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new_export</mode>
                <auth ukey="asd123" checksum="123asd"/>
                <order name="Петр" address="some Address" from_mkad="0" d_date="2010-11-25" b_time="12:00" e_time="13:00" export_quantity="3" transit="no">
                    <contacts>Иван, тел 89876</contacts>
                    <description>propusk</description>
                    <services warrant="no" />
                    <items>
                        <item name="крем" weight="0.400" quantity="2" price="123.55"/>
                        <item name="крем" weight="0.400" quantity="2" price="123.55"/>
                        <item name="крем" weight="0.400" quantity="2" price="123.55"/>
                    </items>
                </order>
            </singleorder>',
            $this->xml->makeXml($newCarry)
        );
    }

    /*
     * TODO в случае если в items передается массив объектов шаблонизатор не может считать их св-ва
     * TODO однако если передовать просто объект, все св-ва считываются корректно
     *
     * решено путем добавления метода OrderItem->asArray() для приведения объектов к массиву (????)
     * */
    function testSingleOrderSelfExportRequest()
    {

        $selfExport = new SingleOrderRequest();

        $item = new OrderItem();
        $item->setName('хлеб')->setQuantity(2)->setPrice(0)->setOrderId(12345)->setWeight(0.4);
        $items = [$item->asArray(), $item->asArray(), $item->asArray()];

        $content = new OrderContent();
        $content->setItems($items);

        $order = new SelfExportOrder();
        $order->setName('vasya')->setCar('A100AA100')->setDayDate('2010-11-25')->setBeginTime('11:00')->setEndTime('13:00')->setQuantity(2)->setPlaces(1)->setTransit(false)->setOrderContent($content);

        $selfExport->setMode('new_self_export')->setAuth((new AuthRequest())->setUkey('123qwe')->setCheckSum('qwe123'))->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new_self_export</mode>
                <auth ukey="123qwe" checksum="qwe123"/>
                <order name="vasya" car="A100AA100" d_date="2010-11-25" quantity="2" places="1" transit="no" b_time="11:00" e_time="13:00">
                    <contacts />
                    <items>
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" oid="12345"/>
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" oid="12345"/>
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" oid="12345"/>
                    </items>
                </order>
            </singleorder>',
            $this->xml->makeXml($selfExport)
        );
    }

    function testSingleOrderRegionCourierRequest()
    {

        $regionCourier = new SingleOrderRequest();

        $item = new OrderItem();
        $item->setName('хлеб')->setQuantity(2)->setPrice(0)->setOrderId(12345)->setWeight(0.4);
        $items = [$item->asArray(), $item->asArray(), $item->asArray()];

        $services = new RegionServices();
        $services->setCheque(false)->setNotOpen(false)->setExtrapack(false)->setBig(true)->setPartReturn(true);

        $address = new OrderAddress();
        $address->setRegionCode(33)->setCityCode(23)->setIndex(123456)->setStreet('some street')->setHouse(30)->setApartment(123);

        $content = new OrderContent();
        $content->setItems($items)->setServices($services)->setAddress($address);

        $order = new RegionCourierOrder();
        $order->setName('vasya')->setDayDate('2010-11-25')->setBeginTime('11:00')->setEndTime('13:00')->setOrderContent($content);

        $regionCourier->setMode('new_region_courier')->setAuth((new AuthRequest())->setUkey('123qwe')->setCheckSum('qwe123'))->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new_region_courier</mode>
                <auth ukey="123qwe" checksum="qwe123"/>
                <order name="vasya" d_date="2010-11-25" b_time="11:00" e_time="13:00">
                    <address region_code="33" city_code="23" index="123456" street="some street" house="30" apartment="123"/>
                    <contacts />
                    <services cheque="no" not_open="no" extrapack="no" big="yes" part_return="yes"/>
                    <items>
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" />
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" />
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" />
                    </items>
                </order>
            </singleorder>',
            $this->xml->makeXml($regionCourier)
        );
    }

    function testSingleOrderRegionPickupRequest()
    {

        $regionPickup = new SingleOrderRequest();

        $item = new OrderItem();
        $item->setName('хлеб')->setQuantity(2)->setPrice(0)->setOrderId(12345)->setWeight(0.4);
        $items = [$item->asArray(), $item->asArray(), $item->asArray()];

        $services = new RegionServices();
        $services->setCheque(false)->setNotOpen(false)->setExtrapack(false)->setBig(true)->setPartReturn(true);

        $address = new OrderAddress();
        $address->setOfficeCode(41);

        $content = new OrderContent();
        $content->setItems($items)->setServices($services)->setAddress($address);

        $order = new RegionCourierOrder();
        $order->setName('vasya')->setDayDate('2010-11-25')->setBeginTime('11:00')->setEndTime('13:00')->setOrderContent($content);

        $regionPickup->setMode('new_region_pickup')->setAuth((new AuthRequest())->setUkey('123qwe')->setCheckSum('qwe123'))->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new_region_pickup</mode>
                <auth ukey="123qwe" checksum="qwe123"/>
                <order name="vasya" d_date="2010-11-25" b_time="11:00" e_time="13:00">
                    <address office_code="41"/>
                    <contacts />
                    <services cheque="no" not_open="no" extrapack="no" big="yes" part_return="yes"/>
                    <items>
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" />
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" />
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" />
                    </items>
                </order>
            </singleorder>',
            $this->xml->makeXml($regionPickup)
        );
    }

    function testSingleOrderBoxberryPickupRequest()
    {

        $boxberryPickup = new SingleOrderRequest();

        $item = new OrderItem();
        $item->setName('хлеб')->setQuantity(2)->setPrice(0)->setOrderId(12345)->setWeight(0.4);
        $items = [$item->asArray(), $item->asArray(), $item->asArray()];

        $services = new BoxberryServices();
        $services->setCheckup(false)->setPartReturn(true)->setCod(true);

        $address = new OrderAddress();
        $address->setOfficeCode(41);

        $content = new OrderContent();
        $content->setItems($items)->setServices($services)->setAddress($address);

        $order = new RegionCourierOrder();
        $order->setName('vasya')->setDayDate('2010-11-25')->setOrderContent($content);

        $boxberryPickup->setMode('new_boxberry_pickup')->setAuth((new AuthRequest())->setUkey('123qwe')->setCheckSum('qwe123'))->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>new_boxberry_pickup</mode>
                <auth ukey="123qwe" checksum="qwe123"/>
                <order name="vasya" d_date="2010-11-25">
                    <address office_code="41"/>
                    <contacts />
                    <services checkup="no" part_return="yes" cod="yes"/>
                    <items>
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" />
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" />
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" />
                    </items>
                </order>
            </singleorder>',
            $this->xml->makeXml($boxberryPickup)
        );
    }

    function testSingleOrderGetPriceDpdRequest()
    {
        $delivery = new SingleOrderRequest();
        $auth = new AuthRequest();

        $services = [
            'valuation' => true,
            'fragile' => false,
            'waiting' => true,
            'cod' => false
        ];
        $items = [
            [
                'name' => 'товар 1',
                'weight' => 2.000,
                'quantity' => 3,
                'price' => 340.55
            ],
            [
                'name' => 'товар 2',
                'weight' => 3.000,
                'quantity' => 5,
                'price' => 555.55
            ]
        ];
        $address = [
            'index' => '321123',
            'region' => 'Камчатский край',
            'area' => 'Москва',
            'street' => 'Литейная',
            'house' => '12а',
            'carrymode' => '10А'
        ];
        $orderContent = [
            'contacts' => 'тел. 8905',
            'services' => $services,
            'address' => $address,
            'items' => $items
        ];

        $order = (new DpdOrder())->setInnerId(123)->setOkey('qwe123')->setName('Кл')->setEndTime('12:00')->setBeginDate('2009-12-14')->setBeginTime('11:00')->setPostType(0)->setOrderContent($orderContent);

        $mode = new Mode();
        $mode->setModeType('dpd')->setOrderType('get_price');
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode($mode)->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode type="dpd">get_price</mode>
                <auth ukey="321ewq" checksum="123qwe"/>
                <order okey="qwe123" inner_id="123" name="Кл" b_date="2009-12-14" e_time="12:00" b_time="11:00" post_type="0">
                    <address index="321123" region="Камчатский край" area="Москва" street="Литейная" house="12а" carrymode="10А" />
                    <contacts>тел. 8905</contacts>
                    <services  valuation="yes" fragile="no" cod="no" waiting="yes" />
                    <items>
                        <item name="товар 1" weight="2" quantity="3" price="340.55"/>
                        <item name="товар 2" weight="3" quantity="5" price="555.55"/>
                    </items>
                </order>
            </singleorder>',
            $this->xml->makeXml($delivery)
        );
    }

    function testGetPriceRegionCourier()
    {
        $regionCourier = new SingleOrderRequest();

        $item = new OrderItem();
        $item->setName('хлеб')->setQuantity(2)->setPrice(0)->setOrderId(12345)->setWeight(0.4);
        $items = [$item->asArray(), $item->asArray(), $item->asArray()];

        $services = new RegionServices();
        $services->setCheque(false)->setNotOpen(false)->setExtrapack(false)->setBig(true)->setPartReturn(true);

        $address = new OrderAddress();
        $address->setRegionCode(33)->setCityCode(23)->setIndex(123456)->setStreet('some street')->setHouse(30)->setApartment(123);

        $content = new OrderContent();
        $content->setItems($items)->setServices($services)->setAddress($address);

        $order = new RegionCourierOrder();
        $order->setName('vasya')->setDayDate('2010-11-25')->setBeginTime('11:00')->setEndTime('13:00')->setOrderContent($content);

        $regionCourier
            ->setMode((new Mode())->setOrderType('get_price')->setModeType('region_courier'))
            ->setAuth((new AuthRequest())->setUkey('123qwe')->setCheckSum('qwe123'))
            ->setOrder($order);

        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode type="region_courier">get_price</mode>
                <auth ukey="123qwe" checksum="qwe123"/>
                <order name="vasya" d_date="2010-11-25" b_time="11:00" e_time="13:00">
                    <address region_code="33" city_code="23" index="123456" street="some street" house="30" apartment="123"/>
                    <contacts />
                    <services cheque="no" not_open="no" extrapack="no" big="yes" part_return="yes"/>
                    <items>
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" />
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" />
                        <item name="хлеб" weight="0.400" quantity="2" price="0.00" />
                    </items>
                </order>
            </singleorder>',
            $this->xml->makeXml($regionCourier)
        );
    }

    function testSingleOrderDeleteRequest()
    {
        $delete = new SingleOrderRequest();
        $delete->setMode('delete')->setAuth('123qwe')->setOkey('some123key');

        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <mode>delete</mode>
                <auth ukey="123qwe"/>
                <okey>some123key</okey>
            </singleorder>',
            $this->xml->makeXml($delete)
        );
    }
}
