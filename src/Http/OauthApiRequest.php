<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/20/18
 * Time: 3:29 PM
 */

namespace Cottect\Http;

class OauthApiRequest extends ApiRequest implements OauthApiRequestInterface
{
    use ClientRequest;
}
