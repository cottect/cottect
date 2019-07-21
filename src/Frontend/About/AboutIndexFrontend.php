<?php

namespace Cottect\Frontend\About;

use Cottect\Frontend\GuestFrontend;
use Symfony\Component\Routing\Annotation\Route;

class AboutIndexFrontend extends GuestFrontend
{
    /**
     * @Route("/about", name="about_index_frontend")
     */
    public function index()
    {
        return $this->render('about/index.html.twig', [
            'controller_name' => self::class,
        ]);
    }
}
