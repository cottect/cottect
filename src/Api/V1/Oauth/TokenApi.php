<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 9:31 AM
 */

namespace Cottect\Api\V1\Oauth;

use Cottect\Entity\User;
use Cottect\Api\V1\GrantTypePasswordApi;
use Cottect\Http\Request\Api\Oauth\TokenApiRequest;
use Cottect\Http\Response;
use Cottect\Http\Response\Api\Oauth\TokenApiResponse;
use Cottect\Services\Oauth\OauthRefreshOauthTokenService;
use Cottect\Services\Oauth\OauthTokenService;
use Cottect\Services\User\UserLoginService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TokenApi extends GrantTypePasswordApi
{
    /**
     * @Route("/oauth/token", name="api_v1_oauth_token")
     * @Method({"POST"})
     *
     * @param Request $request
     * @param UserLoginService $loginService
     * @param TokenApiRequest $tokenApiRequest
     * @param TokenApiResponse $tokenApiResponse
     * @param OauthTokenService $tokenService
     * @param OauthRefreshOauthTokenService $refreshTokenService
     *
     * @return array|bool|false|\Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(
        Request $request,
        UserLoginService $loginService,
        TokenApiRequest $tokenApiRequest,
        TokenApiResponse $tokenApiResponse,
        OauthTokenService $tokenService,
        OauthRefreshOauthTokenService $refreshTokenService
    ) {
        # Handle error
        $errors = $this->initial($request, $tokenApiRequest);
        if ($errors) {
            return $errors;
        }
        # Validate username and password
        $user = $loginService->submit($tokenApiRequest->getUsername(), $tokenApiRequest->getPassword());
        if (!$user instanceof User) {
            $errorKey = $user;
            if ($errorKey == Response::INVALID_USERNAME) {
                $propertyPath = TokenApiRequest::USERNAME_FIELD;
            } else {
                $propertyPath = TokenApiRequest::PASSWORD_FIELD;
            }
            $errors = [
                'parameters' => [
                    'message' => Response::getMessage($errorKey),
                    'property_path' => $propertyPath,
                ],
            ];

            return $this->error(Response::getCode($errorKey), $errorKey, $errors);
        }
        # Generate access token & refresh token
        $accessToken = $tokenService->generate($user->getId(), $tokenApiRequest->getClientId());
        $refreshToken = $refreshTokenService->generate($user->getId(), $tokenApiRequest->getClientId());
        # Set Response data
        $tokenApiResponse->setTokenType($tokenService->getTokenType());
        $tokenApiResponse->setExpiresAt($tokenService->getExpiresAt());
        $tokenApiResponse->setAccessToken($accessToken);
        $tokenApiResponse->setRefreshToken($refreshToken);

        return $this->success($tokenApiResponse->toArray());
    }
}
