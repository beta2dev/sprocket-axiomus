<?php

namespace axi\makeorder\order\desc\serv;

    class AxiomusExportServices
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
