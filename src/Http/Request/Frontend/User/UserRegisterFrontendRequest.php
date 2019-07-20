<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/6/18
 * Time: 12:15 PM
 */

namespace Cottect\Http\Request\Frontend\User;

use Cottect\Http\Request;
use Cottect\Validator\Constraints as CottectAssert;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegisterFrontendRequest extends Request
{
    const USERNAME_FIELD = 'username';
    const PASSWORD_FIELD = 'password';
    const FIRST_NAME_FIELD = 'first_name';
    const LAST_NAME_FIELD = 'last_name';
    const BIRTHDAY_FIELD = 'birthday';
    const GENDER_FIELD = 'gender';

    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $firstName;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $lastName;

    /**
     * @var string
     * @Assert\NotBlank()
     * @CottectAssert\UsernameRegister()
     */
    protected $username;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    protected $birthday;

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
     * @var string
     * @Assert\NotBlank()
     */
    protected $gender;

    public function load($request)
    {
        parent::load($request);
        if (isset($request[self::FIRST_NAME_FIELD])) {
            $this->setFirstName($request[self::FIRST_NAME_FIELD]);
        }
        if (isset($request[self::LAST_NAME_FIELD])) {
            $this->setLastName($request[self::LAST_NAME_FIELD]);
        }
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
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

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

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
}
