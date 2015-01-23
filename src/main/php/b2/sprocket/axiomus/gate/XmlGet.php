<?php

namespace b2\sprocket\axiomus\gate;

use b2\sprocket\axiomus\api\ApplicationResponse;
use b2\sprocket\axiomus\api\GetListResponse;

require_once('C:\Work\Axiomus\foundation\src\main\php\b2\util\XmlMapper.php');

class XmlGet extends \b2\util\XmlMapper
{
    const CLASS_PATH = '\b2\sprocket\axiomus\api\\';


    function responseMap($xml)
    {
        $obj = null;
        $xml = simplexml_load_string($xml);
        switch ($xml->request) {
            case 'new':
                $obj = $this->newResponse()->map($xml, new ApplicationResponse());
                break;
            case 'carry':
                $obj = $this->getList('carry_list/office')->map($xml, new GetListResponse());
                break;
            case 'dpd_pickup':
            case 'boxberry_pickup':
                $obj = $this->getList('pickup_list/office')->map($xml, new GetListResponse());
                break;
            case 'regions':
                $obj = $this->getList('region')->map($xml, new GetListResponse());
                break;
            case 'status':
            case 'get_price':
            case 'delete':
                $obj = $this->getApplicationStatus()->map($xml, new ApplicationResponse());
                break;
            case 'status_list':
                $obj = $this->getList('okeylist/okey')->map($xml, new GetListResponse());
                break;
            case 'get_version':
                $obj = $this->getVersion()->map($xml, new ApplicationResponse());
                break;
            default:
                var_dump($xml->request);
        }
        return $obj;
    }

    private function getVersion()
    {
        return $this->string('version');
    }
    private function newResponse()
    {
        return $this
            ->object('auth')
            ->origin(self::CLASS_PATH . 'AuthResponse')
            ->int('@objectid')
            ->string('text() => auth')
            ->up()
            ->getStatus();
    }

    private function getApplicationStatus()
    {
        return $this
            ->getStatus()
            ->up()
            ->string('d_date => dayDate')
            ->objectFreeContext('order');
    }

    private function getStatus()
    {
        return $this
            ->object('status')
            ->origin(self::CLASS_PATH . 'Status')
            ->float('@price')
            ->int('@code')
            ->string('text() => status');
    }

    private function getList($type)
    {
        return $this->objectFreeContext("$type => list[]");
    }

    function tag_office($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Office')
            ->int('(@office_code) => officeCode')
            ->string('@type')
            ->string('(@office_name) => officeName')
            ->string('(@office_address) => officeAddress')
            ->int('(@city_code) => cityCode')
            ->string('(@city_name) => cityName')
            ->string('@GPS')->string('@WorkSchedule')
            ->string('@Area')->string('@name')
            ->string('@address')->string('@region')
            ->string('@code')->string('@city')
            ->string('text() => office')
            ->int('@OnlyPrepaidOrders');
    }

    function tag_region($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Region')
            ->int('(@region_code) => regionCode')
            ->string('name')
            ->object('courier/city => courier[]')
            ->up()
            ->object('pickup/office => pickup[]');
    }

    function tag_city($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'City')
            ->int('(@city_code) => cityCode')
            ->string('text() => city');
    }

    function tag_order($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'OrderResponse')
            ->float('@price')
            ->float('(@incl_deliv_sum) => inclDelivSum')
            ->applicationInfo()
            ->int('@group')
            ->int('(@export_order) => exportOrder')
            ->int('@fid')
            ->float('(@total_price) => totalPrice')
            ->float('(@agent_price) => agentPrice')
            ->float('(@subagent_price) => subagentPrice');
    }

    function tag_okey($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Okey')
            ->applicationInfo()
            ->int('(@status_code) => statusCode')
            ->string('(@status_name) => statusName')
            ->float('@price')
            ->string('text() => okey');
    }

    function applicationInfo()
    {
        return $this->int('@id')->string('(@inner_id) => innerId')->float('(@customer_price) => customerPrice');
    }
}