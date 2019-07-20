<?php

namespace Cottect\Frontend\Cart;

use Cottect\Frontend\AuthenticationFrontend;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Template;
use Symfony\Component\Routing\Annotation\Route;

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
