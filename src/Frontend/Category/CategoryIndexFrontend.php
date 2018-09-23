<?php

namespace Cottect\Frontend\Category;

use Cottect\Frontend\AuthenticationFrontend;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Template;

class CategoryIndexFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_CATEGORY_INDEX, name=RouteName::FRONTEND_CATEGORY_INDEX)
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render(
            Template::FRONTEND_CATEGORY_INDEX,
            [
                'controller_name' => self::class,
            ]
        );
    }
}
