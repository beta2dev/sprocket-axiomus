<?php


namespace b2\sprocket\axiomus\adapter;

/*
    логика класса:
        тк ответы на некоторые заявки однотипны (okeylist => array(...), offices => array(...), pickuplist => array(...)), воизбежания создание кучи классов(а соответственно и кучи файлов)
        всего с одним аттрибутом, я решил создать 1 класс, но под каждый вид приходящего от сервера массива свой атрибут.
        можно было сделать 1 класс с 1 атрибутом для всех массивов, однако тогда при работе с объектом этого класса было бы не понятно какой конкретно массив пришел и как с ним работать...
        так же + такого решения, на мой взгляд, является адаптивность кода под обновления API аксиомуса
*/
class ArraysResponse {

    private $pickupList;
    private $carryList;
    private $okeylist;
    private $packs;
    private $itemsRefused;
    private $courier;

    function getItemsRefused()
    {
        return $this->itemsRefused;
    }

    function setItemsRefused($itemsRefused)
    {
        $this->itemsRefused = $itemsRefused;
        return $this;
    }

    function getPacks()
    {
        return $this->packs;
    }

    function setPacks($packs)
    {
        $this->packs = $packs;
        return $this;
    }

    function getPickupList()
    {
        return $this->pickupList;
    }

    function setPickupList($pickupList)
    {
        $this->pickupList = $pickupList;
        return $this;
    }

    function getCarryList()
    {
        return $this->carryList;
    }

    function setCarryList($carryList)
    {
        $this->carryList = $carryList;
        return $this;
    }

    function getOkeylist()
    {
        return $this->okeylist;
    }

    function setOkeylist($okeylist)
    {
        $this->okeylist = $okeylist;
        return $this;
    }

}