<?php

function b2tmp($path = null)
{
    global $b2tmp;
    return $path == null ? $b2tmp : \b2\util\Path::concat($b2tmp, $path);
}

