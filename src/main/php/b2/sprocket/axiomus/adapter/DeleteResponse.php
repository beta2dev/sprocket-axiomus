<?php


namespace b2\sprocket\axiomous\adapter;


class DeleteResponse{
    private $id;

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
        return $this;
    }

}