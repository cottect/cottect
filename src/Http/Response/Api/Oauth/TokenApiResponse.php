<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 11:39 AM
 */

namespace Cottect\Http\Response\Api\Oauth;

class TokenApiResponse
{
    protected $tokenType;
    protected $expiresAt;
    protected $accessToken;
    protected $refreshToken;
    protected $scope;

    public function toArray()
    {
        $results = [
            'token_type' => $this->getTokenType(),
            'expires_at' => $this->getExpiresAt(),
            'access_token' => $this->getAccessToken(),
            'refresh_token' => $this->getRefreshToken(),
        ];
        if (!empty($this->getScope())) {
            $results['scope'] = $this->getScope();
        }

        return $results;
    }

    /**
     * @return mixed
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @param mixed $tokenType
     */
    public function setTokenType($tokenType): void
    {
        $this->tokenType = $tokenType;
    }

    /**
     * @return mixed
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param mixed $expiresAt
     */
    public function setExpiresAt($expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return mixed
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param mixed $scope
     */
    public function setScope($scope): void
    {
        $this->scope = $scope;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return mixed
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param mixed $refreshToken
     */
    public function setRefreshToken($refreshToken): void
    {
        $this->refreshToken = $refreshToken;
    }
}
