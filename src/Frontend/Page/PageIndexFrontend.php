<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/15/18
 * Time: 8:08 PM
 */

namespace Cottect\Frontend\Page;

use Cottect\Frontend\AuthenticationFrontend;
use Cottect\Utils\Template;
use Symfony\Component\Routing\Annotation\Route;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;

/**
 * Class PageIndexFrontend
 * @package Cottect\Frontend\Dashboard
 */
class PageIndexFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_PAGE_INDEX, name=RouteName::FRONTEND_PAGE_INDEX)
     */
    public function index()
    {
        $listUrl = [
            'https://cottect.com/wp-content/uploads/2017/11/bfcm-apps-hero.jpg',
            'https://cottect.com/wp-content/uploads/2017/11/marketplaces_hero_bd4de3bc-fcf9-4087-a4f8-bd2a91076bdb.jpg',
            'https://cottect.com/wp-content/uploads/2017/11/Live-view.jpg',
            'https://cottect.com/wp-content/uploads/2017/11/sequential_retargeting_hero.jpg',
        ];
        return $this->render(
            Template::FRONTEND_PAGE_INDEX,
            [
                'controller_name' => 'HomeController',
                'list_images_url' => $listUrl,
                'list_images_url_size' => count($listUrl) - 1,
            ]
        );
    }
}
