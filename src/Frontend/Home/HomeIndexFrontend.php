<?php

namespace Cottect\Frontend\Home;

use Cottect\Form\Frontend\User\UserRegisterFrontendForm;
use Cottect\Frontend\GuestFrontend;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeIndexFrontend extends GuestFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_HOME_INDEX, name=RouteName::FRONTEND_HOME_INDEX)
     *
     * @return Response
     */
    public function index(Request $request)
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
