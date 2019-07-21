<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/20/18
 * Time: 3:04 PM
 */

namespace Cottect\Http\Request\Api\Oauth;

use Cottect\Http\OauthApiRequest;
use Cottect\Validator\Constraints as CottectAssert;
use Symfony\Component\Validator\Constraints as Assert;

class TokenApiRequest extends OauthApiRequest
{
    const USERNAME_FIELD = 'username';
    const PASSWORD_FIELD = 'password';

    /**
     * @var string
     * @Assert\NotBlank()
     * @CottectAssert\Username()
     */
    protected $username;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 8,
     *     max = 255,
     * )
     */
    protected $password;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
