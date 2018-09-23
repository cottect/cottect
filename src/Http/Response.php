<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 11:37 AM
 */

namespace Cottect\Http;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

abstract class Response
{
    const INVALID_REQUEST = 'invalid_request';
    const INVALID_USERNAME = 'invalid_username';
    const INVALID_PASSWORD = 'invalid_password';
    const INVALID_VERIFY_CODE = 'invalid_verify_code';
    const UNSUPPORTED_GRANT_TYPE = 'unsupported_grant_type';

    public static function getCode(string $key)
    {
        $results = [
            self::INVALID_REQUEST => SymfonyResponse::HTTP_BAD_REQUEST,
            self::INVALID_USERNAME => SymfonyResponse::HTTP_UNAUTHORIZED,
            self::INVALID_PASSWORD => SymfonyResponse::HTTP_UNAUTHORIZED,
            self::UNSUPPORTED_GRANT_TYPE => SymfonyResponse::HTTP_NOT_ACCEPTABLE,
        ];

        return $results[$key] ?? $key;
    }

    /**
     * @param $key
     *
     * @return string
     */
    public static function getMessage(string $key)
    {
        $results = [
            self::INVALID_REQUEST => 'Invalid request parameters',
            self::INVALID_USERNAME => 'The username does not exist',
            self::INVALID_PASSWORD => 'The password is incorrect',
            self::UNSUPPORTED_GRANT_TYPE => 'Unsupported grant type',
        ];

        return $results[$key] ?? $key;
    }
}
