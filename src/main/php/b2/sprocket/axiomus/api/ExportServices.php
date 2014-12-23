<?php

namespace b2\sprocket\axiomous\api;

    class ExportServices
    {
        private $warrant;
        private $transit;

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
