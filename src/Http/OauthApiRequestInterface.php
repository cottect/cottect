<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/20/18
 * Time: 3:25 PM
 */

namespace Cottect\Http;

interface OauthApiRequestInterface extends ApiRequestInterface
{
    const CLIENT_ID_FIELD = 'client_id';
    const CLIENT_SECRET_FIELD = 'client_secret';
    const GRANT_TYPE_FIELD = 'grant_type';

    public function getClientId(): string;

    public function setClientId(string $clientId): void;

    public function getClientSecret(): string;

    public function setClientSecret(string $clientSecret): void;

    public function getGrantType(): string;

    public function setGrantType(string $grantType): void;
}
