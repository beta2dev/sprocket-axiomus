<?php

namespace b2\sprocket\axiomous\api;

class OrderServices
{
    protected $cash;
    protected $cheque;
    protected $card;
    protected $big;
    protected $cod;
    protected $partReturn;

    function getPartReturn()
    {
        return $this->partReturn;
    }

    function setPartReturn($partReturn)
    {
        $this->partReturn = $partReturn;
        return $this;
    }

    function getCod()
    {
        return $this->cod;
    }

    function setCod($cod)
    {
        $this->cod = $cod;
        return $this;
    }

    function getCash()
    {
        return $this->cash;
    }
    function setCash($cash)
    {
        $this->cash = $cash;
        return $this;
    }

    function getCheque()
    {
        return $this->cheque;
    }
    function setCheque($cheq)
    {
        $this->cheque = $cheq;
        return $this;
    }

    function getCard()
    {
        return $this->card;
    }
    function setCard($card)
    {
        $this->card = $card;
        return $this;
    }

    function getBig()
    {
        return $this->big;
    }
    function setBig($big)
    {
        $this->big = $big;
        return $this;
    }
}