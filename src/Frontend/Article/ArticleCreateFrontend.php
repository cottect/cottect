<?php

namespace Cottect\Frontend\Article;

use Cottect\Frontend\AuthenticationFrontend;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Template;
use Symfony\Component\Routing\Annotation\Route;

class ArticleCreateFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_ARTICLE_CREATE, name=RouteName::FRONTEND_ARTICLE_CREATE)
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render(
            Template::FRONTEND_ARTICLE_CREATE,
            [
                'controller_name' => 'ArticleCreateFrontend',
            ]
        );
    }
}
