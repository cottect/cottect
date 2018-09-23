<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/5/18
 * Time: 10:42 AM
 */

namespace Cottect\Services\Sms;

class SmsSenderService
{
    protected $phone;
    protected $countryCode;

    public function send($data)
    {
        return true;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param mixed $countryCode
     */
    public function setCountryCode($countryCode): void
    {
        $this->countryCode = $countryCode;
    }
}
