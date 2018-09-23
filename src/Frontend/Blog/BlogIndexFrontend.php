<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/15/18
 * Time: 8:14 PM
 */

namespace Cottect\Frontend\Blog;

use Cottect\Frontend\AuthenticationFrontend;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Frontend used to manage blog contents in the public part of the site.
 *
 * @Route("/blog")
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class BlogIndexFrontend extends AuthenticationFrontend
{
    const ROUTE_NAME = 'blog_index';

    /**
     * @Route("/", name="blog_index")
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'ProductIndexFrontend',
        ]);
    }
}
