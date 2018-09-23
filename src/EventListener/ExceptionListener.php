<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/17/18
 * Time: 10:35 PM
 */

namespace Cottect\EventListener;

use Cottect\Api\V1\Api;
use Cottect\Exception\AuthenticatedException;
use Cottect\Exception\UnauthenticatedException;
use Cottect\Exception\UnverifiedException;
use Cottect\Utils\RouteName;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ExceptionListener
{
    protected $debug;
    protected $environment;
    protected $router;

    /**
     * @var GetResponseForExceptionEvent
     */
    private $event;

    public function __construct(RouterInterface $router)
    {
        $this->debug = getenv('APP_DEBUG');
        $this->environment = getenv('APP_ENV');
        $this->router = $router;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $uri = $event->getRequest()->getRequestUri();
        if (strcasecmp(substr($uri, 0, 4), '/api') == 0) {
            $this->apiException($event);
        }
        $this->event = $event;
        $exception = $event->getException();
        if ($exception instanceof AuthenticatedException) {
            $this->authenticatedException();
        }
        if ($exception instanceof UnauthenticatedException) {
            $this->unauthenticatedException();
        }
        if ($exception instanceof UnverifiedException) {
            $this->unverifiedException();
        }
    }

    public function apiException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();
        $response = new JsonResponse();
        // HttpExceptionInterface is a special type of exception that
        if ($exception instanceof HttpExceptionInterface) {
            $code = $exception->getStatusCode();
            // holds header details
            $response->headers->replace($exception->getHeaders());
        } else {
            $code = $exception->getCode() != 0 ? $exception->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        $response->setStatusCode($code);
        $error = [
            'line' => $exception->getLine(),
            'file' => $exception->getFile(),
            'trace' => explode(PHP_EOL, $exception->getTraceAsString()),
        ];
        $message = $exception->getMessage();
        if (!$this->debug || (strcasecmp($this->environment, 'dev') != 0)) {
            $error = null;
            if ($code >= Response::HTTP_INTERNAL_SERVER_ERROR) {
                $message = 'Internal server error';
            } else {
                $exception->getMessage();
            }
        }
        $responseData = Api::makeErrorMessage($code, $message, $error);
        $response->setData($responseData);
        $event->setResponse($response);
    }

    public function authenticatedException()
    {
        $this->redirect(RouteName::FRONTEND_DASHBOARD_INDEX);
    }

    public function unauthenticatedException()
    {
        $this->redirect(RouteName::FRONTEND_USER_LOGIN);
    }

    public function unverifiedException()
    {
        $this->redirect(RouteName::FRONTEND_USER_CHECKPOINT);
    }

    private function redirect($routeName)
    {
        $url = $this->router->generate($routeName);
        $response = new RedirectResponse($url);
        $this->event->setResponse($response);
    }
}
