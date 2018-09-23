<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/18/18
 * Time: 10:13 PM
 */

namespace Cottect\Utils;

use Firebase\JWT\JWT as FirebaseJWT;

class JWT
{
    public static function encode($payload)
    {
        return FirebaseJWT::encode($payload, getenv('APP_SECRET'));
    }
}
