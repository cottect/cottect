<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/20/18
 * Time: 9:40 PM
 */

namespace Cottect\Api\V1\Oauth;

use Cottect\Api\V1\GrantTypeRefreshTokenApi;
use Cottect\Http\Request\Api\Oauth\RefreshTokenApiRequest;
use Cottect\Http\Response\Api\Oauth\RefreshTokenApiResponse;
use Cottect\Services\Oauth\OauthRefreshOauthTokenService;
use Cottect\Services\Oauth\OauthTokenService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RefreshTokenApi extends GrantTypeRefreshTokenApi
{
    /**
     * @Route("/oauth/refresh_token", name="api_v1_oauth_refresh_token", methods={"POST"})
     *
     * @param Request $request
     * @param RefreshTokenApiRequest $refreshTokenApiRequest
     * @param RefreshTokenApiResponse $refreshTokenApiResponse
     * @param OauthTokenService $tokenService
     * @param OauthRefreshOauthTokenService $refreshTokenService
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(
        Request $request,
        RefreshTokenApiRequest $refreshTokenApiRequest,
        RefreshTokenApiResponse $refreshTokenApiResponse,
        OauthTokenService $tokenService,
        OauthRefreshOauthTokenService $refreshTokenService
    )
    {
        # Handle error
        $errors = $this->initial($request, $refreshTokenApiRequest);
        if ($errors) {
            return $errors;
        }
        # Get user from refresh token
        $refreshTokenService->setToken($refreshTokenApiRequest->getRefreshToken());
        $user = $refreshTokenService->getUser();
        # Generate access token & refresh token
        $accessToken = $tokenService->generate($user->getId(), $refreshTokenApiRequest->getClientId());
        $refreshToken = $refreshTokenService->generate($user->getId(), $refreshTokenApiRequest->getClientId());
        # Set Response data
        $refreshTokenApiResponse->setTokenType($tokenService->getTokenType());
        $refreshTokenApiResponse->setExpiresAt($tokenService->getExpiresAt());
        $refreshTokenApiResponse->setAccessToken($accessToken);
        $refreshTokenApiResponse->setRefreshToken($refreshToken);

        return $this->success($refreshTokenApiResponse->toArray());
    }
}
