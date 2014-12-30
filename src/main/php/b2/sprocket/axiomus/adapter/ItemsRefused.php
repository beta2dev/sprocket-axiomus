<?php


namespace b2\sprocket\axiomus\adapter;


class ItemsRefused {
    private $items;

    function getItems()
    {
        return $this->items;
    }

    function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

}