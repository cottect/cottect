<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/15/18
 * Time: 10:35 PM
 */

namespace Cottect\Api\V1\Home;

use Cottect\Api\V1\GrantTypeRegisterApi;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class IndexApi
 * @package Cottect\Api\V1\Home
 */
class IndexApi extends GrantTypeRegisterApi
{
    /**
     * @Route("/", name="api_v1_home_index")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        return $this->success(
            [
                'service' => getenv('SERVICE_NAME'),
                'version' => 'v1',
                'time' => date('Y-m-d H:i:s', time()),
                'timezone' => date_default_timezone_get(),
                'ip' => getHostByName(getHostName()),
            ]
        );
    }
}
