<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/15/18
 * Time: 10:35 PM
 */

namespace Cottect\Api\V1;

use Cottect\Http\ApiRequestInterface;
use Cottect\Http\RequestInterface;
use Cottect\Http\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class Api
 * @package Cottect\Api\V1\Base
 */
abstract class Api extends AbstractController implements ApiInterface
{
    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * Api constructor.
     *
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $code
     * @param $message
     * @param $errors
     *
     * @return array
     */
    public static function makeErrorMessage(int $code, $message, $errors)
    {
        $result = [
            'code' => $code,
            'message' => $message,
            'errors' => $errors,
        ];
        if (empty($errors)) {
            unset($result['errors']);
        }

        return $result;
    }

    /**
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    protected function success($data = [])
    {
        return $this->json($data);
    }

    /**
     * @param $code
     * @param $message
     * @param $errors
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    protected function error(int $code, $message, $errors)
    {
        $data = self::makeErrorMessage($code, $message, $errors);

        return $this->json($data, $code);
    }

    /**
     * @param Request $request
     * @param ApiRequestInterface $apiRequest
     *
     * @return false|JsonResponse
     */
    protected function initial(Request $request, ApiRequestInterface &$apiRequest)
    {
        $data = $this->parseJsonRequest($request);
        $apiRequest->load($data);
        $errors = $this->validate($apiRequest);
        if ($errors) {
            $errorKey = Response::INVALID_REQUEST;
            $errorCode = Response::getCode($errorKey);

            return $this->error($errorCode, $errorKey, $errors);
        }

        return false;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    protected function parseJsonRequest(Request $request)
    {
        $contentType = $request->headers->get(RequestInterface::HEADER_CONTENT_TYPE);
        if ($contentType == RequestInterface::HEADER_APPLICATION_JSON) {
            return json_decode($request->getContent(), true);
        }

        return null;
    }

    /**
     * @param $object
     *
     * @return mixed
     */
    protected function validate($object)
    {
        /**
         * @var $errors ConstraintViolationList
         */
        $errors = $this->validator->validate($object);
        if (count($errors) > 0) {
            $errorsArray = $errors->getIterator()->getArrayCopy();
            $errorsData = [];
            foreach ($errorsArray as $error) {
                /**
                 * @var $error ConstraintViolation
                 */
                $errorsData[] = [
                    'message' => $error->getMessage(),
                    'property_path' => $error->getPropertyPath(),
                ];
            }

            return $errorsData;
        }

        return false;
    }
}
