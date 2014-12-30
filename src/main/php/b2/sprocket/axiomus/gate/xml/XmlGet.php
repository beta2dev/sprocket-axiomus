<?php

namespace b2\sprocket\axiomus\gate\xml;

require_once('C:\Work\Axiomus\foundation\src\main\php\b2\util\XmlMapper.php');

class XmlGet extends \b2\util\XmlMapper{

    const CLASS_PATH = '\b2\sprocket\axiomus\adapter\\';

    function applicationInfo()
    {
        return $this->int('@id')->string('(@inner_id) => innerId')->float('(@customer_price) => customerPrice');
    }
    function tag_refused_items($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'ArraysResponse')->objectFreeContext('item => itemsRefused[]');
    }
    function tag_okeylist($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'ArraysResponse')->objectFreeContext('okey => okeylist[]');
    }
    function tag_carry_list($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'ArraysResponse')->objectFreeContext('office => carryList[]');
    }
    function tag_pickup_list($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'ArraysResponse')->objectFreeContext('office => pickupList[]');
    }
    function tag_packs($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'ArraysResponse')->objectFreeContext('pack => packs[]');
    }
    function tag_response($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Response')->objectFreeContext('* => items[]');
    }

    function tag_auth($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Auth')->int('@objectid')->string('text() => auth');
    }
    function tag_request($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Request')->string('text() =>request');
    }
    function tag_status($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Status')->float('@price')->int('@code')->string('text() =>status');
    }

    function tag_order($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Order')->float('@price')->float('(@incl_deliv_sum) => inclDelivSum')->applicationInfo()->int('@group')->int('(@export_order) => exportOrder')->int('@fid');
    }

    function tag_d_date($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'DayDate')->string('text() => dayDate');
    }
    function tag_item($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Item')->string('@name')->int('@quantity')->float('@price');
    }

    function tag_poststatus($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'PostStatus')->int('@tracking')->float('@postprice');
    }

    function tag_pack($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Pack')->int('@number')->int('@places')->int('@status');
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
            ->string('@GPS')
            ->string('@WorkSchedule')
            ->string('@Area')->string('@name')
            ->string('@address')->string('@region')
            ->int('@code')->string('@city')
            ->string('text() => office');
    }

    function tag_region($mapper)
    {
        $mapper->origin(self::CLASS_PATH. 'Region')->int('(@region_code) => regionCode')->string('name')
            ->object('courier/city => courier[]')
                ->up()
            ->object('pickup/office => pickup[]');
    }
    function tag_okey($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Okey')->applicationInfo()->int('(@status_code) => statusCode')->string('(@status_name) => statusName')->float('@price')->string('text() => okey');
    }

    function tag_city()
    {
        $this->origin(self::CLASS_PATH . 'City')->int('(@city_code) => cityCode')->string('text() => city');
    }
}