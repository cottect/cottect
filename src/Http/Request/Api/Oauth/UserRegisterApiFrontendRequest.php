<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/20/18
 * Time: 2:21 PM
 */

namespace Cottect\Http\Request\Api\Oauth;

use Cottect\Http\ClientRequest;
use Cottect\Http\OauthApiRequestInterface;
use Cottect\Http\Request\Frontend\User\UserRegisterFrontendRequest;

class UserRegisterApiFrontendRequest extends UserRegisterFrontendRequest implements OauthApiRequestInterface
{
    use ClientRequest;
}
