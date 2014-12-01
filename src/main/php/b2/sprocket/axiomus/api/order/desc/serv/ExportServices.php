<?php

namespace b2\sprocket\axiomous\api\order\desc\serv;

    class ExportServices
    {
        protected $warrant;
        protected $transit;

        function getWarrant()
        {
            return $this->warrant;
        }

        function setWarrant($warrant)
        {
            $this->warrant = $warrant;
            return $this;
        }

        function getTransit()
        {
            return $this->transit;
        }

        function setTransit($bool)
        {
            $this->transit = $bool;
            return $this;
        }
    }
