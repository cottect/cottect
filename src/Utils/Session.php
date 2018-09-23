<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/15/18
 * Time: 7:34 PM
 */

namespace Cottect\Utils;

use Cottect\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Session
{
    const USER = 'user';
    const REGISTER_TYPE = 'registerType';
    const PHONE_NUMBER = 'phoneNumber';
    const EMAIL = 'email';

    public static $data = [];

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function clear()
    {
        $this->session->clear();
    }

    public function set($name, $value)
    {
        $this->session->set($name, $value);
    }

    public function get($name, $default = null)
    {
        if (!isset(self::$data[$name])) {
            self::$data[$name] = $this->session->get($name, $default);
        }
        return self::$data[$name];
    }

    /**
     * @return User | null
     */
    public function getUser()
    {
        return $this->get(self::USER);
    }

    /**
     * @param $user
     */
    public function setUser($user)
    {
        $this->set(self::USER, $user);
    }
}
