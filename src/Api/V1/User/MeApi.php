<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 11:25 AM
 */

namespace Cottect\Api\V1\User;

use Cottect\Api\V1\AuthenticationApi;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class MeApi extends AuthenticationApi
{
    /**
     * @Route("/user/me", name="api_v1_user_index")
     * @Method({"GET"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $data = [
            'id' => 'bb7d0a085c2d11e884940242ac120005',
            'username' => null,
            'phone' => '0906807975',
            'email' => 'dinhnhatbang@gmail.com',
            'first_name' => 'Dinh',
            'last_name' => 'Bang',
            'birthday' => '1994-12-20',
            'gender' => 'male',
            'verified' => null
        ];
        return $this->success($data);
    }
}
