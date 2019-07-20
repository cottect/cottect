<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/5/18
 * Time: 11:36 AM
 */

namespace Cottect\Frontend\User;

use Cottect\Form\Frontend\User\UserCheckpointFrontendForm;
use Cottect\Frontend\AuthenticationFrontend;
use Cottect\Services\User\UserCheckpointService;
use Cottect\Services\User\UserRegisterFactoryService;
use Cottect\Utils\Country;
use Cottect\Utils\Session;
use Cottect\Utils\Template;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Routing\Annotation\Route;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;

class UserCheckpointFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_USER_CHECKPOINT, name=RouteName::FRONTEND_USER_CHECKPOINT)
     *
     * @param Request $request
     * @param Session $session
     * @param UserCheckpointService $userCheckpointService
     *
     * @return RedirectResponse|Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function index(Request $request, Session $session, UserCheckpointService $userCheckpointService)
    {
        $user = $session->getUser();

        if (!empty($user->getVerified())) {
            return $this->redirectToRoute(RouteName::FRONTEND_DASHBOARD_INDEX);
        }

        if (!empty($user->getEmail())) {
            $registerType = UserRegisterFactoryService::BY_EMAIL;
            $registerAccount = $user->getEmail();
        } else {
            $registerType = UserRegisterFactoryService::BY_PHONE;
            $registerAccount = $user->getPhone();
        }

        $form = $this->createForm(UserCheckpointFrontendForm::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || ($form->isSubmitted() && !$form->isValid())) {
            $localeCode = $request->getLocale();
            $countryCode = Country::getCountryCodeFromLocaleCode($localeCode);
            $countryName = Intl::getRegionBundle()->getCountryName($countryCode);
            $verifiedBy = $registerType;
            $user = $userCheckpointService->verified($user, $verifiedBy);
            $session->setUser($user);

            return $this->render(
                Template::FRONTEND_USER_CHECKPOINT,
                [
                    'form' => $form->createView(),
                    'registerType' => $registerType,
                    'errors' => $form->getErrors(),
                    'registerAccount' => $registerAccount,
                    'countryName' => $countryName,
                ]
            );
        }

        return $this->redirectToRoute(RouteName::FRONTEND_DASHBOARD_INDEX);
    }
}
