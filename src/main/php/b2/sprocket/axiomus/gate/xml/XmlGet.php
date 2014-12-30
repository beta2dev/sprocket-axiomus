<?php

namespace b2\sprocket\axiomus\gate\xml;

require_once('C:\Work\Axiomus\foundation\src\main\php\b2\util\XmlMapper.php');

class XmlGet extends \b2\util\XmlMapper{

    const CLASS_PATH = '\b2\sprocket\axiomus\adapter\\';

    function tag_request($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Request')->string('text() =>request');
    }

    function tag_response($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Response')->objectFreeContext('* => items[]');
    }

    function tag_auth($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Auth')->int('@objectid')->string('text() => auth');
    }

    function tag_status($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Status')->float('@price')->int('@code')->string('text() =>status');
    }

    function tag_order($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Order')->int('@id')->int('(@inner_id) => innerId')->float('@price')->float('(@customer_price) => customerPrice')->float('(@incl_deliv_sum) => inclDelivSum')
            ->int('@group')->int('(@export_order) => exportOrder')->int('@fid');
    }

    function tag_d_date($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'DayDate')->string('text() => dayDate');
    }

    function tag_refused_items($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'ItemsRefused')->objectFreeContext('item => items[]');
    }

    function tag_item($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Item')->string('@name')->int('@quantity')->float('@price');
    }

    function tag_poststatus($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'PostStatus')->int('@tracking')->float('@postprice');
    }

    function tag_packs($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'ListPacks')->objectFreeContext('pack => packs[]');
    }

    function tag_pack($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Pack')->int('@number')->int('@places')->int('@status');
    }
/*
    function tag_carry_list($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'ListResponse')->objectFreeContext('* => offices[]');
    }

    function tag_office($mapper)
    {
        $mapper->origin(self::CLASS_PATH . 'Office')->int('@office_code')->string('@type')->string('@office_name')->string('@office_address')->int('@city_code')->string('@city_name')
            ->string('@GPS')->string('@WorkSchedule')->string('@Area')->string('@name')->string('@address')->string('@region')->int('@code');
    }

    function tag_region($mapper)
    {
        $mapper->origin(self::CLASS_PATH. 'Region')->int('@region_code')->string('name');
    }
*/
}