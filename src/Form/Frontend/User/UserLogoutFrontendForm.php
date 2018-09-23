<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 8/25/18
 * Time: 3:17 PM
 */

namespace Cottect\Form\Frontend\User;

use Cottect\Utils\RouteName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

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
