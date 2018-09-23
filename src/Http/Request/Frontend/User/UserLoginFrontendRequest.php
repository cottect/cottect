<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/29/18
 * Time: 8:57 PM
 */

namespace Cottect\Http\Request\Frontend\User;

use Symfony\Component\Validator\Constraints as Assert;

class UserLoginFrontendRequest
{
    const USERNAME_FIELD = 'username';
    const PASSWORD_FIELD = 'password';

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }
}
