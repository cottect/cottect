<?php

namespace Cottect\Frontend\Features;


use Cottect\Frontend\GuestFrontend;
use Cottect\Utils\Template;
use Symfony\Component\Routing\Annotation\Route;

class FeatureIndexFrontend extends GuestFrontend
{
    /**
     * @Route("/features", name="features_index_frontend")
     */
    public function index()
    {
        return $this->render(Template::FRONTEND_PRICING_INDEX, [
            'controller_name' => static::class,
        ]);
    }
}
