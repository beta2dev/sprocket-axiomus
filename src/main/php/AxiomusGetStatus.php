<?php

namespace axi{

    class AxiomusGetStatus
    {
        protected $mode;
        protected $okey;


        function getMode()
        {
            return $this->mode;
        }

        function setMode($mode)
        {
            $this->mode = $mode;
            return $this;
        }

        function getOkey()
        {
            return $this->okey;
        }

        function setOkey($okey)
        {
            $this->okey = $okey;
            return $this;
        }
    }
}