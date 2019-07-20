<?php

namespace Cottect\Frontend\Article;

use Cottect\Frontend\AuthenticationFrontend;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Template;
use Symfony\Component\Routing\Annotation\Route;

class ArticleDetailFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_ARTICLE_DETAIL, name=RouteName::FRONTEND_ARTICLE_DETAIL)
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render(
            Template::FRONTEND_ARTICLE_DETAIL,
            [
                'controller_name' => 'ArticleDetailController',
            ]
        );
    }
}
