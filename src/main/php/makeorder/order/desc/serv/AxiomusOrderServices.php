<?php

namespace axi\makeorder\order\desc\serv;

class AxiomusOrderServices
{
    protected $cash;
    protected $cheque;
    protected $card;
    protected $big;

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