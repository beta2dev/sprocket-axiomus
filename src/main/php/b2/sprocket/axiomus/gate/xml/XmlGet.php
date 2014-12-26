<?php

namespace b2\sprocket\axiomous\gate\xml;

require_once('C:\Work\Axiomus\foundation\src\main\php\b2\util\XmlMapper.php');

class XmlGet extends \b2\util\XmlMapper{

    function tag_request($mapper)
    {
        $mapper->object('request','\b2\sprocket\axiomus\adapter\Request')->string('request')->up();
    }

    function tag_response($mapper)
    {
        $mapper->origin('\b2\sprocket\axiomus\adapter\Response')->objectFreeContext('* => items[]');
    }

    function tag_auth($mapper)
    {
        $mapper->object('auth', '\Auth')->string('@objectid')->string('auth')->up();
    }

    function tag_status($mapper)
    {
        $mapper->object('status', '\Status')->float('@price')->int('@code')->string('status')->up();
    }

    function tag_carry_list($mapper)
    {
        $mapper->object('carry_list','\CarryList')->objectFreeContext('* => offices[]');
    }
}