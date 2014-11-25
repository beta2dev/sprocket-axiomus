<?php

namespace axi{

    abstract class AxiomusCreateOrder
    {
        protected $auth;  // AxiomusAuth
        protected $mode;  // AxiomusMode
        protected $order; // AxiomusOrder

        function getAuth()
        {
            return $this->auth;
        }
        function setAuth($auth)
        {
            $this->auth = $auth;
            return $this;
        }

        function getMode()
        {
            return $this->mode;
        }

        function setMode($mode)
        {
            $this->mode = $mode;
            return $this;
        }

        function getOrder()
        {
            return $this->order;
        }

        function setOrder($order)
        {
            $this->order = $order;
            return $this;
        }


    }
}