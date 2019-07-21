<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/5/18
 * Time: 11:30 AM
 */

namespace Cottect\Frontend\User;

use Cottect\Form\Frontend\User\UserRegisterFrontendForm;
use Cottect\Frontend\GuestFrontend;
use Cottect\Http\Request\Frontend\User\UserRegisterFrontendRequest;
use Cottect\Services\Page\PageCreateService;
use Cottect\Services\User\UserRegisterFactoryService;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Cottect\Utils\Session;
use Cottect\Utils\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserRegisterFrontend extends GuestFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_USER_REGISTER, name=RouteName::FRONTEND_USER_REGISTER)
     *
     * @param Request $request
     * @param UserRegisterFrontendRequest $registerRequest
     * @param UserRegisterFactoryService $registerFactoryService
     * @param PageCreateService $pageCreateService
     * @param Session $session
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function index(
        Request $request,
        UserRegisterFrontendRequest $registerRequest,
        UserRegisterFactoryService $registerFactoryService,
        PageCreateService $pageCreateService,
        Session $session
    )
    {
        $form = $this->createForm(UserRegisterFrontendForm::class, $registerRequest);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || ($form->isSubmitted() && !$form->isValid())) {
            return $this->render(
                Template::FRONTEND_USER_REGISTER,
                [
                    'form' => $form->createView(),
                    'errors' => $form->getErrors(),
                ]
            );
        }
        $session->clear();
        $user = $registerFactoryService->save($registerRequest);
        $pageCreateService->createAfterRegisterSuccessful($user);

        $session->set(Session::USER, $user);

        return $this->redirectToRoute(RouteName::FRONTEND_USER_CHECKPOINT);
    }
}
