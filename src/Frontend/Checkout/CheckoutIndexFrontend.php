<?php

namespace Cottect\Frontend\Checkout;

use Cottect\Frontend\AuthenticationFrontend;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Template;

class CheckoutIndexFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_CHECKOUT_INDEX, name=RouteName::FRONTEND_CHECKOUT_INDEX)
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render(
            Template::FRONTEND_CHECKOUT_INDEX,
            [
                'controller_name' => self::class,
            ]
        );
    }
}
