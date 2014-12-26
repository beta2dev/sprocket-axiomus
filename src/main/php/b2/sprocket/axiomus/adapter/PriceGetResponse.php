<?php


namespace b2\sprocket\axiomous\adapter;


class PriceGetResponse{
    private $totalPrice;
    private $agentPrice;
    private $subagentPrice;

    function getTotalPrice()
    {
        return $this->totalPrice;
    }

    function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    function getAgentPrice()
    {
        return $this->agentPrice;
    }

    function setAgentPrice($agentPrice)
    {
        $this->agentPrice = $agentPrice;
        return $this;
    }

    function getSubagentPrice()
    {
        return $this->subagentPrice;
    }

    function setSubagentPrice($subagentPrice)
    {
        $this->subagentPrice = $subagentPrice;
        return $this;
    }

}