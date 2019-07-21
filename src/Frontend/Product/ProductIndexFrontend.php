<?php

namespace Cottect\Frontend\Product;

use Cottect\Frontend\AuthenticationFrontend;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Template;
use Symfony\Component\Routing\Annotation\Route;

class ProductIndexFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_PRODUCT_INDEX, name=RouteName::FRONTEND_PRODUCT_INDEX)
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render(
            Template::FRONTEND_PRODUCT_INDEX,
            [
                'controller_name' => 'ArticleDetailController',
            ]
        );
    }
}
