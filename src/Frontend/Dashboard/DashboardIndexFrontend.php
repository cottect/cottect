<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/15/18
 * Time: 8:08 PM
 */

namespace Cottect\Frontend\Dashboard;

use Cottect\Frontend\AuthenticationFrontend;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductIndexFrontend
 * @package Cottect\Frontend\Dashboard
 */
class DashboardIndexFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_DASHBOARD_INDEX, name=RouteName::FRONTEND_DASHBOARD_INDEX)
     * @param Request $request
     * @param SessionInterface $session
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, SessionInterface $session)
    {
        $listUrl = [
            'https://cdn.shopify.com/s/files/1/0070/7032/files/instagram_stickers_hero.png?v=1537977758',
            'https://cdn.shopify.com/s/files/1/0070/7032/files/AR_hero_blog_ART.jpg?v=1536951978',
            'https://cdn.shopify.com/s/files/1/0070/7032/files/shopify_masters_blog_wintersmiths.png?v=1534191098',
            'https://cdn.shopify.com/s/files/1/0070/7032/files/shopify_masters_blog_kitty-poo-club.png?v=1533921365',
        ];
        return $this->render(
            Template::FRONTEND_DASHBOARD_INDEX,
            [
                'controller_name' => 'HomeController',
                'list_images_url' => $listUrl,
                'list_images_url_size' => count($listUrl) - 1,
            ]
        );
    }
}
