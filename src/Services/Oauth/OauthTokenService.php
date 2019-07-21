<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 2:33 PM
 */

namespace Cottect\Services\Oauth;

use Cottect\Services\User\UserService;
use Cottect\Utils\JWT;

class OauthTokenService
{
    const TOKEN_TYPE = 'Bearer';

    const EXPIRES_IN = 3600; // Valid for 1 hours

    protected $expiresAt;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var OauthClientService
     */
    protected $oauthClientService;

    /**
     * OauthTokenService constructor.
     *
     * @param UserService $userService
     * @param OauthClientService $oauthClientService
     */
    public function __construct(
        UserService $userService,
        OauthClientService $oauthClientService
    )
    {
        $this->userService = $userService;
        $this->oauthClientService = $oauthClientService;
    }

    public function generate($userId, $clientId, $scope = [])
    {
        $tokenData = $this->getTokenData($userId, $clientId, $scope);
        return JWT::encode($tokenData);
    }

    protected function getTokenData($userId, $clientId, $scope = [])
    {
        $issuedAt = time();
        $this->expiresAt = $issuedAt + self::EXPIRES_IN;
        $tokenData = [
            'sub' => $userId,
            'iss' => getenv('SERVICE_URL'),
            'aud' => $clientId,
            'iat' => $issuedAt,
            'exp' => $this->expiresAt,
            'scope' => $scope,
        ];

        return $tokenData;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    public function getTokenType()
    {
        return self::TOKEN_TYPE;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getUserIdentifier()
    {
        return '';
    }

    public function getClientIdentifier()
    {
        return '';
    }

    public function getUser()
    {
        $userId = $this->getUserIdentifier();
        $user = $this->userService->getById($userId);

        return $user;
    }

    public function getClient()
    {
        $clientId = $this->getClientIdentifier();
        $client = $this->oauthClientService->getById($clientId);

        return $client;
    }
}
