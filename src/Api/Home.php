<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/15/18
 * Time: 10:35 PM
 */

namespace Cottect\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Home
 * @package Cottect\Api
 */
class Home extends AbstractController
{
    /**
     * @Route("/", name="api")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        return $this->json(
            [
                'service' => getenv('SERVICE_NAME'),
                'time' => date('Y-m-d H:i:s', time()),
                'timezone' => date_default_timezone_get(),
                'ip' => getHostByName(getHostName()),
            ]
        );
    }
}
