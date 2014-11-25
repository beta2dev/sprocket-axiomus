<?php

namespace axi{

    class AxiomusGetApiVersion
    {
        protected $mode = 'get_version';

        function getMode()
        {
            return $this->mode;
        }
        function setMode($mode)
        {
            $this->mode = $mode;
            return $this;
        }
    }
}