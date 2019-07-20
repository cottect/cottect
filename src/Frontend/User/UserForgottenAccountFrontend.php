<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/5/18
 * Time: 11:46 AM
 */

namespace Cottect\Frontend\User;

use Cottect\Form\Frontend\User\UserCheckpointFrontendForm;
use Cottect\Frontend\GuestFrontend;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserForgottenAccountFrontend extends GuestFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_USER_FORGOTTEN_ACCOUNT, name=RouteName::FRONTEND_USER_FORGOTTEN_ACCOUNT)
     *
     * @return Response
     */
    public function forgottenAccount()
    {
        $form = $this->createForm(UserCheckpointFrontendForm::class);
        return $this->render(
            Template::FRONTEND_USER_FORGOTTEN_ACCOUNT,
            [
                'form' => $form->createView(),
                'error' => $form->getErrors(),
            ]
        );
    }
}
