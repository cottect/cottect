<?php

namespace Cottect\Frontend\Manage;

use Cottect\Frontend\AuthenticationFrontend;

use Cottect\Utils\Template;
use Symfony\Component\Routing\Annotation\Route;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;

class ManageIndexFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_MANAGE_INDEX, name=RouteName::FRONTEND_MANAGE_INDEX)
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render(
            Template::FRONTEND_MANAGE_INDEX,
            [
                'controller_name' => 'ManageDetailController',
            ]
        );
    }
}
