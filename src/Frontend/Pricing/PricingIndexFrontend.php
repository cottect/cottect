<?php

namespace Cottect\Frontend\Pricing;


use Cottect\Frontend\GuestFrontend;
use Cottect\Utils\Template;
use Symfony\Component\Routing\Annotation\Route;

class PricingIndexFrontend extends GuestFrontend
{
    /**
     * @Route("/pricing", name="pricing_index_frontend")
     */
    public function index()
    {
        return $this->render(Template::FRONTEND_PRICING_INDEX, [
            'controller_name' => static::class,
        ]);
    }
}
