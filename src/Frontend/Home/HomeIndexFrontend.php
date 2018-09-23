<?php

namespace Cottect\Frontend\Home;

use Cottect\Form\Frontend\User\UserRegisterFrontendForm;
use Cottect\Frontend\GuestFrontend;
use Cottect\Utils\Template;

use Symfony\Component\Routing\Annotation\Route;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;

class HomeIndexFrontend extends GuestFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_HOME_INDEX, name=RouteName::FRONTEND_HOME_INDEX)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $form = $this->createForm(UserRegisterFrontendForm::class);
        return $this->render(
            Template::FRONTEND_HOME_INDEX,
            [
                'form' => $form->createView(),
            ]
        );
    }
}
