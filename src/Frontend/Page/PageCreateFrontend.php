<?php

namespace Cottect\Frontend\Page;

use Cottect\Frontend\AuthenticationFrontend;

use Cottect\Utils\Template;
use Symfony\Component\Routing\Annotation\Route;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;

class PageCreateFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_PAGE_CREATE, name=RouteName::FRONTEND_PAGE_CREATE)
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render(
            Template::FRONTEND_PAGE_CREATE,
            [
                'controller_name' => 'PageCreateFrontend',
            ]
        );
    }
}
