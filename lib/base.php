<?php

class Base
{
    public static $aRoutes = [];

    public static function fnResponse()
    {
        $mResult = false;
        $sM = $_REQUEST['method'];

        if (isset(static::$aRoutes[$sM])) {
            $mResult = static::{static::$aRoutes[$sM][0]}();
        }

        return $mResult;
    }
}