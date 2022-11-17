<?php
namespace App\Libraries;

class DateFormat
{
    public static function ganti($format)
    {
        return str_replace("/","-", $format);
    }

    public static function gantiFormat($datetime)
    {
        return date('Y-m-d H:i:s', strtotime($datetime));
    }
}
