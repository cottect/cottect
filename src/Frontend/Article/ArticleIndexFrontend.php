<?php

namespace Cottect\Frontend\Article;

use Cottect\Frontend\AuthenticationFrontend;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Template;
use Symfony\Component\Routing\Annotation\Route;

class ArticleIndexFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_ARTICLE_INDEX, name=RouteName::FRONTEND_ARTICLE_INDEX)
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $listUrl = [
            'https://cottect.com/wp-content/uploads/2017/11/bfcm-apps-hero.jpg',
            'https://cottect.com/wp-content/uploads/2017/11/marketplaces_hero_bd4de3bc-fcf9-4087-a4f8-bd2a91076bdb.jpg',
            'https://cottect.com/wp-content/uploads/2017/11/Live-view.jpg',
            'https://cottect.com/wp-content/uploads/2017/11/sequential_retargeting_hero.jpg',
            'https://cdn-images-1.medium.com/max/2000/1*DIpg-kS0ZbdJ9XxThTp4kw.jpeg',
        ];
        return $this->render(Template::FRONTEND_ARTICLE_INDEX, [
            'controller_name' => 'ArticleController',
            'list_images_url' => $listUrl,
            'list_images_url_size' => count($listUrl) - 1,
        ]);
    }
}
