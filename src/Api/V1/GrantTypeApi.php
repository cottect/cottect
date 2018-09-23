<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/20/18
 * Time: 2:34 PM
 */

namespace Cottect\Api\V1;

use Cottect\Http\OauthApiRequestInterface as OauthInterface;
use Cottect\Http\Response;
use Cottect\Services\Oauth\OauthClientService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class GrantTypeApi extends Api implements GrantTypeInterface
{
    /**
     * @var OauthClientService
     */
    protected $oauthClientService;

    /**
     * GrantTypeApi constructor.
     *
     * @param ValidatorInterface $validator
     * @param OauthClientService $oauthClientService
     */
    public function __construct(ValidatorInterface $validator, OauthClientService $oauthClientService)
    {
        parent::__construct($validator);
        $this->oauthClientService = $oauthClientService;
    }

    /**
     * @param Request $request
     * @param OauthInterface $oauthApiRequest
     *
     * @return bool|false|\Symfony\Component\HttpFoundation\JsonResponse
     */
    protected function initial(Request $request, &$oauthApiRequest)
    {
        $data = $this->parseJsonRequest($request);

        $oauthApiRequest->setClientId($data[OauthInterface::CLIENT_ID_FIELD] ?? '');
        $oauthApiRequest->setClientSecret($data[OauthInterface::CLIENT_SECRET_FIELD] ?? '');
        $oauthApiRequest->setGrantType($data[OauthInterface::GRANT_TYPE_FIELD] ?? '');

        $errors = parent::initial($request, $oauthApiRequest);
        if ($errors) {
            return $errors;
        }

        if (!$this->check($oauthApiRequest->getGrantType())) {
            $errorKey = Response::UNSUPPORTED_GRANT_TYPE;
            return $this->error(
                Response::getCode($errorKey),
                $errorKey,
                [
                    'parameters' => [
                        'grant_type' => [
                            'message' => Response::getMessage($errorKey),
                            'property_path' => OauthInterface::GRANT_TYPE_FIELD,
                            'invalid_value' => $oauthApiRequest->getGrantType(),
                        ],
                    ],
                ]
            );
        }

        return false;
    }

    /**
     * @param $grantType
     *
     * @return bool
     */
    protected function check($grantType)
    {
        if (in_array($grantType, $this->oauthClientService->getGrantTypeSupported())) {
            return true;
        }

        return false;
    }
}
