<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/13/18
 * Time: 9:20 PM
 */

namespace Cottect\Utils;

class Date
{
    const MINIMUM_ACCEPTED_YEAR = 1905;

    public static function yearChoiceOverTwelveYear()
    {
        $currentYear = (int)date('Y');
        $acceptedYear = $currentYear - 12;
        $results = [];
        for ($i = $acceptedYear; $i >= self::MINIMUM_ACCEPTED_YEAR; $i--) {
            $results[$i] = $i;
        }
        return $results;
    }
}
