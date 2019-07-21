<?php

namespace Cottect\Frontend\Message;

use Cottect\Frontend\AuthenticationFrontend;
use Symfony\Component\Routing\Annotation\Route;

class MessageIndexFrontend extends AuthenticationFrontend
{
    /**
     * @Route("/message", name="message")
     */
    public function index()
    {
        return $this->render('message/index.html.twig', [
            'controller_name' => 'ProductIndexFrontend',
        ]);
    }
}
