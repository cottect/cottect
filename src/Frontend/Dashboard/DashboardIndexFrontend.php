<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/15/18
 * Time: 8:08 PM
 */

namespace Cottect\Frontend\Dashboard;

use Cottect\Frontend\AuthenticationFrontend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Template;

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
            'https://cottect.com/wp-content/uploads/2017/11/bfcm-apps-hero.jpg',
            'https://cottect.com/wp-content/uploads/2017/11/marketplaces_hero_bd4de3bc-fcf9-4087-a4f8-bd2a91076bdb.jpg',
            'https://cottect.com/wp-content/uploads/2017/11/Live-view.jpg',
            'https://cottect.com/wp-content/uploads/2017/11/sequential_retargeting_hero.jpg',
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
