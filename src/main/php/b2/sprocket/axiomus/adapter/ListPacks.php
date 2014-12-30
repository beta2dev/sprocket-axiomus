<?php


namespace b2\sprocket\axiomus\adapter;


class ListPacks {

    private $packs;

    function getPacks()
    {
        return $this->packs;
    }

    function setPacks($packs)
    {
        $this->packs = $packs;
        return $this;
    }

}