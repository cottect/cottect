<?php

namespace Cottect\Frontend\Cart;

use Cottect\Frontend\AuthenticationFrontend;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Template;

class CartIndexFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_CART_INDEX, name=RouteName::FRONTEND_CART_INDEX)
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render(
            Template::FRONTEND_CART_INDEX,
            [
                'controller_name' => 'ProductIndexFrontend',
            ]
        );
    }
}
