<?php

namespace b2\sprocket\axiomous\gate\xml;

use b2\sprocket\axiomous\api\auth\Auth;
use b2\sprocket\axiomous\api\mode\Mode;
use b2\sprocket\axiomous\api\order\desc\delivset\below\DelivsetBelow;
use b2\sprocket\axiomous\api\order\desc\delivset\OrderDelivset;
use b2\sprocket\axiomous\api\order\desc\OrderContent;
use b2\sprocket\axiomous\api\order\desc\services\OrderServices;
use b2\sprocket\axiomous\api\order\item\OrderItem;
use b2\sprocket\axiomous\api\order\Order;
use b2\sprocket\axiomous\api\SingleOrderCarryStatusRequest;
use b2\sprocket\axiomous\api\SingleOrderDeliveryRequest;

define('B2_FOUNDATION_TEMPLATES','C:\Work\Axiomus\foundation\src\main\php\b2\templates');
define('B2_AXIOMUS_TEMPLATES','C:\Work\Axiomus\sprocket-axiomus\src\main\php\b2\sprocket\axiomus');
define('XML_HEADER', '<?xml version="1.0" encoding="UTF-8"?>');

require_once B2_AXIOMUS_TEMPLATES .'\gate\xml\MakeXml.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\auth\Auth.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\mode\Mode.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\Order.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\OrderPost.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\CarryOrder.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\desc\OrderContent.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\desc\delivset\below\DelivsetBelow.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\desc\address\OrderAddress.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\desc\delivset\OrderDelivset.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\desc\discountset\below\DiscountBelow.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\desc\discountset\OrderDiscountset.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\desc\services\OrderServices.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\desc\services\ExportServices.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\desc\services\PostServices.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\order\desc\item\OrderItem.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\SingleOrderRequest.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\SingleOrderStatusRequest.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\SingleOrderStatusListRequest.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\SingleOrderDeliveryRequest.php';
require_once B2_AXIOMUS_TEMPLATES . '\api\SingleOrderCarryStatusRequest.php';
require_once B2_FOUNDATION_TEMPLATES . '\..\util\String.php';
require_once B2_FOUNDATION_TEMPLATES . '\XmlTemplate.php';
require_once B2_FOUNDATION_TEMPLATES . '\XmlTemplateOptions.php';

require_once __DIR__ . '\..\..\..\test.boot.php';

//require_once 'C:\Work\Axiomus\sprocket-axiomus\src\test\php\b2\sprocket\test.boot.php';

class MakeXmlTest extends \PHPUnit_Framework_TestCase {

    function testSingleOrderStatusRequest_objects()
    {
        $status = new \b2\sprocket\axiomous\api\SingleOrderStatusRequest();
        $xml = new MakeXml();

        $status->setMode('status')->setOkey('23fs2fsd3');

        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<singleorder><mode>status</mode><okey>23fs2fsd3</okey></singleorder>',
            $xml->SingleOrderStatusRequest($status)
        );
    }

    function testSingleOrderCarryStatus_MskStP()
    {
        $status = new SingleOrderCarryStatusRequest();
        $xml = new MakeXml();
        $status->setMode('get_carry')->setAuth('123qwe');

        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<singleorder><mode>get_carry</mode><auth ukey="123qwe"/></singleorder>',
            $xml->SingleOrderCarryStatusRequest($status)
        );
    }

    function testSingleOrderCarryStatus_DPD()
    {
        $status = new SingleOrderCarryStatusRequest();
        $xml = new MakeXml();
        $status->setMode('get_dpd_pickup')->setAuth('321ewq');

        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<singleorder><mode>get_dpd_pickup</mode><auth ukey="321ewq"/></singleorder>',
            $xml->SingleOrderCarryStatusRequest($status)
        );
    }

    function testSingleOrderStatusRequest_Arrays()
    {
        $status = new \b2\sprocket\axiomous\api\SingleOrderStatusRequest();
        $xml = new MakeXml();
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER . '<singleorder><mode>status</mode><okey>23fs2fsd3</okey></singleorder>',
            $xml->SingleOrderStatusRequest(array('okey'=>'23fs2fsd3', 'mode'=>array('orderType'=>'status')))
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

    function testSingleOrderDeliveryRequest_Arrays()
    {
        $delivery = new SingleOrderDeliveryRequest();
        $auth = new Auth();
        $xml = new MakeXml();
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
        $order = [
            'order' => [
                'innerId' => '123',
                'name' => 'Кл',
                'address' => 'Москва...',
                'fromMkad' => '0',
                'dayDate' => '2009-12-14',
                'beginTime' => '12:00',
                'endTime' => '13:00',
                'places' => '1',
                'city' => '0',
                'sms' => '8905',
                'orderContent' => $orderContent
            ]
        ];
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <auth ukey="321ewq" checksum="123qwe"/>
                <mode>new</mode>
                <order inner_id="123" name="Кл" address="Москва..." from_mkad="0.00" d_date="2009-12-14" b_time="12:00" e_time="13:00" places="1" city="0" sms="8905">
                    <contacts>тел. 8905</contacts>
                    <description>сзади</description>
                    <services cash="yes" cheque="no" />
                    <items>
                        <item name="товар 1" weight="2.000" quantity="3" price="340.55"/>
                        <item name="товар 2" weight="3.000" quantity="5" price="555.55"/>
                    </items>
                    <delivset return_price="20.000" above_price="50.000">
                        <below below_sum="100.000" price="250.000" />
                        <below below_sum="500.000" price="150.000" />
                    </delivset>
                </order>
            </singleorder>',
            $xml->SingleOrderDeliveryRequest($delivery)
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
        $orderContent->setItem($item)->setDelivset($delivset)->setServices($services)->setContacts('тел. 8905')->setDescription('сзади');

        $order = new Order();
        $order->setOrderContent($orderContent)->setAddress('Москва...')->setBeginTime('12:00')->setCity(0)->setDayDate('2009-12-14')->setEmail('mail@ru')->setEndTime('13:00')
            ->setSms(8905)->setName('Кл')->setInnerId('123')->setPlaces(1);

        $mode = new Mode();
        $mode->setOrderType('new');

        $auth = new Auth();
        $auth->setUkey('321ewq')->setCheckSum('123qwe');

        $delivery = new SingleOrderDeliveryRequest();
        $delivery->setAuth($auth)->setMode($mode)->setOrder($order);

        $xml = new MakeXml();

        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <auth ukey="321ewq" checksum="123qwe"/>
                <mode>new</mode>
                <order inner_id="123" name="Кл" address="Москва..." d_date="2009-12-14" places="1" b_time="12:00" e_time="13:00" city="0" sms="8905" email="mail@ru">
                    <contacts>тел. 8905</contacts>
                    <description>сзади</description>
                    <services cash="yes" />
                    <item name="товар 1" weight="2.000" quantity="3" price="340.55"/>
                    <delivset return_price="20.000" above_price="50.000">
                        <below below_sum="100.000" price="250.000" />
                    </delivset>
                </order>
            </singleorder>',
            $xml->SingleOrderDeliveryRequest($delivery)
        );
    }

    function testSingleOrderDeliveryRequest_WithioutDelivset()
    {
        $delivery = new SingleOrderDeliveryRequest();
        $auth = new Auth();
        $xml = new MakeXml();
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
        $order = [
            'order' => [
                'innerId' => '123',
                'name' => 'Кл',
                'address' => 'Москва...',
                'fromMkad' => '0',
                'dayDate' => '2009-12-14',
                'beginTime' => '12:00',
                'endTime' => '13:00',
                'places' => '1',
                'city' => '0',
                'sms' => '8905',
                'orderContent' => $orderContent
            ]
        ];
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <auth ukey="321ewq" checksum="123qwe"/>
                <mode>new</mode>
                <order inner_id="123" name="Кл" address="Москва..." from_mkad="0.00" d_date="2009-12-14" b_time="12:00" e_time="13:00" places="1" city="0" sms="8905">
                    <contacts>тел. 8905</contacts>
                    <description>сзади</description>
                    <services cash="yes" cheque="no" />
                    <items>
                        <item name="товар 1" weight="2.000" quantity="3" price="340.55"/>
                        <item name="товар 2" weight="3.000" quantity="5" price="555.55"/>
                    </items>
                </order>
            </singleorder>',
            $xml->SingleOrderDeliveryRequest($delivery)
        );
    }

    function testSingleOrderDeliveryRequest_MinOrder()
    {
        $delivery = new SingleOrderDeliveryRequest();
        $auth = new Auth();
        $xml = new MakeXml();
        $items = [
            'name' => 'товар 1',
            'weight' => 2.000,
            'quantity' => 3,
            'price' => 340.55
        ];
        $orderContent = [
            'contacts' => 'тел. 8905',
            'items' => $items
        ];
        $order = [
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
        ];
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <auth ukey="321ewq" checksum="123qwe"/>
                <mode>new</mode>
                <order name="Кл" address="Москва..." d_date="2009-12-14" b_time="12:00" e_time="13:00" places="1" city="0">
                    <contacts>тел. 8905</contacts>
                    <item name="товар 1" weight="2.000" quantity="3" price="340.55"/>
                </order>
            </singleorder>',
            $xml->SingleOrderDeliveryRequest($delivery)
        );
    }

    function testSingleOrderDeliveryRequest_MinWithDiscount()
    {
        $delivery = new SingleOrderDeliveryRequest();
        $auth = new Auth();
        $xml = new MakeXml();
        $items = [
            'name' => 'товар 1',
            'weight' => 2.000,
            'quantity' => 3,
            'price' => 340.55
        ];
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
        $order = [
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
        ];
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <auth ukey="321ewq" checksum="123qwe"/>
                <mode>new</mode>
                <order name="Кл" address="Москва..." d_date="2009-12-14" b_time="12:00" e_time="13:00" places="1" city="0">
                    <contacts>тел. 8905</contacts>
                    <item name="товар 1" weight="2.000" quantity="3" price="340.55"/>
                    <discountset  above_discount="15.000">
                        <below  below_sum="1000.000" discount="0.000"/>
                        <below  below_sum="3000.500" discount="5.000"/>
                    </discountset>
                </order>
            </singleorder>',
            $xml->SingleOrderDeliveryRequest($delivery)
        );
    }

    function testSingleOrderPostRequest()
    {
        $delivery = new SingleOrderDeliveryRequest();
        $auth = new Auth();
        $xml = new MakeXml();
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
        $order = [
            'post' => [
                'innerId' => '123',
                'okey' => 'qwe123',
                'name' => 'Кл',
                'beginDate' => '2009-12-14',
                'sms' => '8905',
                'postType' => 0,
                'orderContent' => $orderContent
            ]
        ];
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new_post')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <auth ukey="321ewq" checksum="123qwe"/>
                <mode>new_post</mode>
                <order okey="qwe123" inner_id="123" name="Кл" b_date="2009-12-14" sms="8905" post_type="0">
                    <address index="321123" region="Камчатский край" area="Москва" p_address="ул. Блабла, д.3, кв.20" />
                    <contacts>тел. 8905</contacts>
                    <services  valuation="yes" fragile="no" cod="no"  />
                    <items>
                        <item name="товар 1" weight="2.000" quantity="3" price="340.55"/>
                        <item name="товар 2" weight="3.000" quantity="5" price="555.55"/>
                    </items>
                </order>
            </singleorder>',
            $xml->SingleOrderPostRequest($delivery)
        );
    }

    function testSingleOrderPostRequest_OneArray()
    {
        $delivery = new SingleOrderDeliveryRequest();
        $auth = new Auth();
        $xml = new MakeXml();
        $order = [
            'post' => [
                'innerId' => '123',
                'okey' => 'qwe123',
                'name' => 'Кл',
                'beginDate' => '2009-12-14',
                'sms' => '8905',
                'postType' => 0,
                'orderContent' => [
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
            ]
        ];

        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new_post')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <auth ukey="321ewq" checksum="123qwe"/>
                <mode>new_post</mode>
                <order okey="qwe123" inner_id="123" name="Кл" b_date="2009-12-14" sms="8905" post_type="0">
                    <address index="321123" region="Камчатский край" area="Москва" p_address="ул. Блабла, д.3, кв.20" />
                    <contacts>тел. 8905</contacts>
                    <services valuation="yes" fragile="no" cod="yes" big="yes" class1="yes" post_tarif="no" not_avia="yes" oprimize="no" sms_inform="yes" insurance="no" />
                    <items>
                        <item name="товар 1" weight="2.000" quantity="3" price="340.55"/>
                        <item name="товар 2" weight="3.000" quantity="5" price="555.55"/>
                    </items>
                </order>
            </singleorder>',
            $xml->SingleOrderPostRequest($delivery)
        );
    }

    function testSingleOrderDpdRequest()
    {
        $delivery = new SingleOrderDeliveryRequest();
        $auth = new Auth();
        $xml = new MakeXml();
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
        $order = [
            'post' => [
                'innerId' => '123',
                'okey' => 'qwe123',
                'name' => 'Кл',
                'endTime' => '12:00',
                'beginTime' => '11:00',
                'beginDate' => '2009-12-14',
                'postType' => 0,
                'orderContent' => $orderContent
            ]
        ];
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new_dpd')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <auth ukey="321ewq" checksum="123qwe"/>
                <mode>new_dpd</mode>
                <order okey="qwe123" inner_id="123" name="Кл" b_date="2009-12-14" e_time="12:00" b_time="11:00" post_type="0">
                    <address index="321123" region="Камчатский край" area="Москва" street="Литейная" house="12а" carrymode="10А" />
                    <contacts>тел. 8905</contacts>
                    <services  valuation="yes" fragile="no" cod="no" waiting="yes" />
                    <items>
                        <item name="товар 1" weight="2.000" quantity="3" price="340.55"/>
                        <item name="товар 2" weight="3.000" quantity="5" price="555.55"/>
                    </items>
                </order>
            </singleorder>',
            $xml->SingleOrderDpdRequest($delivery)
        );
    }

    function testSingleOrderCarryRequest_withNoNeedData()
    {
        $delivery = new SingleOrderDeliveryRequest();
        $auth = new Auth();
        $xml = new MakeXml();
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
        $order = [
            'carry' => [
                'okey' => '321qwe',
                'innerId' => '123',
                'name' => 'Кл',
                'address' => 'Москва...',
                'fromMkad' => '0',
                'dayDate' => '2009-12-14',
                'beginDate' => '2009-11-12',
                'endDate' => '2009-11-15',
                'places' => '1',
                'sms' => '8905',
                'orderContent' => $orderContent
            ]
        ];
        $auth->setCheckSum('123qwe')->setUkey('321ewq');
        $delivery->setMode('new')->setAuth($auth)->setOrder($order);
        $this->assertXmlStringEqualsXmlString(
            XML_HEADER .
            '<singleorder>
                <auth ukey="321ewq" checksum="123qwe"/>
                <mode>new</mode>
                <order okey="321qwe" inner_id="123" name="Кл" b_date="2009-11-12" e_date="2009-11-15" places="1" sms="8905">
                    <contacts>тел. 8905</contacts>
                    <description>сзади</description>
                    <services cash="yes" cheque="no" big="yes"/>
                    <items>
                        <item name="товар 1" weight="2.000" quantity="3" price="340.55" expmode="1"/>
                        <item name="товар 2" weight="3.000" quantity="5" price="555.55"/>
                    </items>
                    <delivset return_price="20.000" above_price="50.000">
                        <below below_sum="100.000" price="250.000" />
                        <below below_sum="500.000" price="150.500" />
                    </delivset>
                </order>
            </singleorder>',
            $xml->SingleOrderCarryRequest($delivery)
        );
    }
}
