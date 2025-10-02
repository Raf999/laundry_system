<?php

namespace App\Services;

class Util
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function formatNumber($number): string
    {
        if ($number >= 1000000) {
            return number_format($number / 1000000, ) . 'M';
        } elseif ($number >= 1000) {
            return number_format($number / 1000, 1) . 'k';
        }

        return number_format($number, null, '.', ',');
    }
}
