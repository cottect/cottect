<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 9:15 PM
 */

namespace Cottect\Utils;

class Random
{
    public function generateToken()
    {
        $bytes = random_bytes(32);

        return base_convert(bin2hex($bytes), 16, 36);
    }
}
