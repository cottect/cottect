<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/15/18
 * Time: 7:21 PM
 */

namespace Cottect\Utils;

use Symfony\Component\Intl\Intl;

class Country
{
    const DEFAULT_LOCALE_CODE = 'en_US';

    public static $localeCountry = [
        'vi' => 'VN',
        'en' => 'US',
    ];

    public static $countryPhoneNumberCode = [
        'VN' => 84
    ];

    public static function getCountryCodeFromLocaleCode($localeCode)
    {
        $locales = Intl::getLocaleBundle()->getLocaleNames();
        if (isset(self::$localeCountry[$localeCode])) {
            return self::$localeCountry[$localeCode];
        }
        if (!isset($locales[$localeCode]) || !isset(explode('_', $localeCode)[1])) {
            $localeCode = self::DEFAULT_LOCALE_CODE;
        }
        $countryCode = explode('_', $localeCode)[1];

        return $countryCode;
    }
}
