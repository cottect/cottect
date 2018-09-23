<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/5/18
 * Time: 11:30 AM
 */

namespace Cottect\Frontend;

use Cottect\Entity\User;
use Cottect\Utils\Session;
use Cottect\Frontend\Home\HomeIndexFrontend as HomeIndexController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

abstract class AuthenticationFrontend extends Frontend implements AuthenticationFrontendInterface
{

}
