<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/30/18
 * Time: 9:22 PM
 */

namespace Cottect\EventSubscriber;

use Cottect\Entity\User;
use Cottect\Exception\UnverifiedException;
use Cottect\Frontend\AuthenticationFrontendInterface;
use Cottect\Frontend\User\UserCheckpointFrontend;
use Cottect\Utils\Session;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class VerificationSubscriber implements EventSubscriberInterface
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }

    /**
     * @param FilterControllerEvent $event
     *
     * @return bool
     * @throws UnverifiedException
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return true;
        }

        if (($controller[0] instanceof AuthenticationFrontendInterface) &&
            (get_class($controller[0]) !== UserCheckpointFrontend::class)
        ) {
            $user = $this->session->get(Session::USER);
            if ($user instanceof User) {
                if (empty($user->getVerified())) {
                    throw new UnverifiedException('Unverified');
                }
            }
        }

        return true;
    }
}
