<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/20/18
 * Time: 6:01 PM
 */

namespace Cottect\Services\Oauth;

class OauthRefreshOauthTokenService extends OauthTokenService
{
    const EXPIRES_IN = 2592000 ; // Valid for 1 month

    protected function getTokenData($userId, $clientId, $scope = [])
    {
        $issuedAt = time();
        $this->expiresAt = $issuedAt + self::EXPIRES_IN;
        $tokenData = [
            # Subject (The user ID)
            'sub' => $userId,

            # Issuer (the token endpoint)
            'iss' => getenv('SERVICE_URL'),

            # Audience (intended for use by the client that generated the token)
            'aud' => $clientId,

            # Issued At
            'iat' => $issuedAt,

            # Expires At
            'exp' => $this->expiresAt,

            # The list of OAuth scopes this token includes
            'scope' => $scope,
        ];

        return $tokenData;
    }
}
