<?php

namespace Cottect\Form\Frontend\User;

use Cottect\Utils\RouteName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormBuilderInterface;

class UserLogoutFrontendForm extends AbstractType
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod(Request::METHOD_POST)
            ->setAction($this->router->generate(RouteName::FRONTEND_USER_LOGOUT));
    }
}
