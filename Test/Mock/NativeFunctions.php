<?php
namespace JSomerstone\JSFramework;

class NativeFunctions
{
    public static $headers = array();

    public static function header($headerString)
    {
        self::$headers[] = $headerString;
    }

    public static function getHeaders()
    {
        return self::$headers;
    }
}