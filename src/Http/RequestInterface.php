<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 11:38 AM
 */

namespace Cottect\Http;

interface RequestInterface
{
    const HEADER_CONTENT_TYPE = 'Content-Type';
    const HEADER_APPLICATION_JSON = 'application/json';

    public function load($request);
}
