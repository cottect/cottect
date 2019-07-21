<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/15/18
 * Time: 10:35 PM
 */

namespace Cottect\Api\V1\Oauth;

use Cottect\Api\V1\GrantTypeRegisterApi;
use Cottect\Http\Request\Api\Oauth\UserRegisterApiFrontendRequest;
use Cottect\Http\Response\Api\Oauth\RegisterApiResponse;
use Cottect\Services\Oauth\OauthRefreshOauthTokenService;
use Cottect\Services\Oauth\OauthTokenService;
use Cottect\Services\User\UserRegisterFactoryService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RegisterApiApi
 * @package Cottect\Api\V1\User
 */
class RegisterApi extends GrantTypeRegisterApi
{
    /**
     * @Route("/oauth/register", name="api_v1_oauth_register", methods={"POST"})
     *
     * @param Request $request
     * @param UserRegisterApiFrontendRequest $registerApiRequest
     * @param RegisterApiResponse $registerApiResponse
     * @param UserRegisterFactoryService $registerFactoryService
     * @param OauthTokenService $tokenService
     * @param OauthRefreshOauthTokenService $refreshTokenService
     *
     * @return bool|false|\Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function index(
        Request $request,
        UserRegisterApiFrontendRequest $registerApiRequest,
        RegisterApiResponse $registerApiResponse,
        UserRegisterFactoryService $registerFactoryService,
        OauthTokenService $tokenService,
        OauthRefreshOauthTokenService $refreshTokenService
    )
    {
        # Handle error
        $errors = $this->initial($request, $registerApiRequest);
        if ($errors) {
            return $errors;
        }
        # Create user
        $user = $registerFactoryService->save($registerApiRequest);
        # Generate access token & refresh token
        $accessToken = $tokenService->generate($user->getId(), $registerApiRequest->getClientId());
        $refreshToken = $refreshTokenService->generate($user->getId(), $registerApiRequest->getClientId());
        # Set Response data
        $registerApiResponse->setTokenType($tokenService->getTokenType());
        $registerApiResponse->setExpiresAt($tokenService->getExpiresAt());
        $registerApiResponse->setAccessToken($accessToken);
        $registerApiResponse->setRefreshToken($refreshToken);

        return $this->success($registerApiResponse->toArray());
    }
}
