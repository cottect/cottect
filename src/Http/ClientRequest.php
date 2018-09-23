<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/20/18
 * Time: 2:17 PM
 */

namespace Cottect\Http;

use Symfony\Component\Validator\Constraints as Assert;

trait ClientRequest
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $clientId;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $clientSecret;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $grantType;

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret(string $clientSecret): void
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return string
     */
    public function getGrantType(): string
    {
        return $this->grantType;
    }

    /**
     * @param string $grantType
     */
    public function setGrantType(string $grantType): void
    {
        $this->grantType = $grantType;
    }
}
