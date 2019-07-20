<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/5/18
 * Time: 11:30 AM
 */

namespace Cottect\Frontend\User;

use Cottect\Entity\User;
use Cottect\Form\Frontend\User\UserLoginFrontendForm;
use Cottect\Frontend\GuestFrontend;
use Cottect\Http\Request\Frontend\User\UserLoginFrontendRequest;
use Cottect\Services\User\UserLoginService;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Session;
use Cottect\Utils\Template;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

class UserLoginFrontend extends GuestFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_USER_LOGIN, name=RouteName::FRONTEND_USER_LOGIN)
     *
     * @param Request $request
     * @param UserLoginFrontendRequest $loginRequest
     * @param UserLoginService $loginService
     * @param Session $session
     * @param TranslatorInterface $translator
     *
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(
        Request $request,
        UserLoginFrontendRequest $loginRequest,
        UserLoginService $loginService,
        Session $session,
        TranslatorInterface $translator
    ): Response
    {
        $form = $this->createForm(UserLoginFrontendForm::class, $loginRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $loginService->submit($loginRequest->getUsername(), $loginRequest->getPassword());
            if ($user instanceof User) {
                $session->set(Session::USER, $user);

                return $this->redirectToRoute(RouteName::FRONTEND_DASHBOARD_INDEX);
            } else {
                if ($user == \Cottect\Http\Response::INVALID_USERNAME) {
                    $form
                        ->get(UserLoginFrontendRequest::USERNAME_FIELD)
                        ->addError(new FormError($translator->trans('user.login.invalid_username')));
                } else {
                    $form
                        ->get(UserLoginFrontendRequest::PASSWORD_FIELD)
                        ->addError(new FormError($translator->trans('user.login.invalid_password')));
                }
            }
        }

        return $this->render(
            Template::FRONTEND_USER_LOGIN,
            [
                'form' => $form->createView(),
                'errors' => $form->getErrors(),
            ]
        );
    }
}
