<?php

namespace App\Common;

class RequestCheck
{
    public static function cleanString($input, $default = Constants::DEFAULT_EMPTY_STRING) {
        return (isset($input) || !is_null($input)) ? trim($input) : $default;
    }

    public static function cleanStringSort($input, $default = 'asc') {
        return (isset($input) || !is_null($input)) ? (($input) == 'desc' ? 'desc' : 'asc') : $default;
    }

    public static function cleanNumber($input, $default = Constants::DEFAULT_EMPTY_NUMBER) {
        return isset($input) ? floatval($input) : $default;
    }
}
