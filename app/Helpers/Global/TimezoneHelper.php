<?php

use JamesMills\LaravelTimezone\Timezone;

if (! function_exists('timezone')) {
    /**
     * Access the timezone helper.
     */
    function timezone()
    {
        return resolve(Timezone::class);
    }
}

if (!function_exists('convert_date_to_string')) {
    /**
     * Convert date to string date
     *
     * @param $date
     * @return string
     */
    function convert_date_to_string($date): string
    {
        return date('d/m/Y', strtotime($date));
    }
}

if (!function_exists('convert_date_time_to_string')) {
    /**
     * Convert date_time to string date
     *
     * @param $date
     * @return string
     */
    function convert_date_time_to_string($date): string
    {
        return date('d/m/Y H:i:s', strtotime($date));
    }
}

if (!function_exists('convert_string_to_date')) {

    function convert_string_to_date($string, string $format)
    {
        return date($format, strtotime(str_replace('/', '-', $string)));
    }
}

