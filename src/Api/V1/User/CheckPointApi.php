<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/15/18
 * Time: 10:35 PM
 */

namespace Cottect\Api\V1\User;

use Cottect\Api\V1\GrantTypeRegisterApi;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CheckPointApi
 * @package Cottect\Api\V1\User
 */
class CheckPointApi extends GrantTypeRegisterApi
{
    /**
     * @Route("/checkpoint", name="api_v1_user_checkpoint")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        return $this->success('Hello word!');
    }
}
