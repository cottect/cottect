<?php


namespace Cottect\Form\Frontend;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Routing\RouterInterface;

abstract class BaseFormFrontend extends AbstractType
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
}
