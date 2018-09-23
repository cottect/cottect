<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/20/18
 * Time: 9:42 PM
 */

namespace Cottect\Http\Request\Api\Oauth;

use Cottect\Http\OauthApiRequest;

class RefreshTokenApiRequest extends OauthApiRequest
{
    const REFRESH_TOKEN_FIELD = 'refresh_token';

    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $refreshToken;

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     */
    public function setRefreshToken(string $refreshToken): void
    {
        $this->refreshToken = $refreshToken;
    }
}
