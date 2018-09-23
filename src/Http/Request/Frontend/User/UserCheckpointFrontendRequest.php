<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/7/18
 * Time: 10:29 PM
 */

namespace Cottect\Http\Request\Frontend\User;

use Symfony\Component\Validator\Constraints as Assert;

class UserCheckpointFrontendRequest
{
    const VERIFY_CODE_FIELD = 'verifyCode';

    /**
     * @var integer
     * @Assert\NotBlank()
     * @Assert\Length(min=6, max=6)
     */
    protected $verifyCode;

    /**
     * @return mixed
     */
    public function getVerifyCode()
    {
        return $this->verifyCode;
    }

    /**
     * @param mixed $verifyCode
     */
    public function setVerifyCode($verifyCode): void
    {
        $this->verifyCode = $verifyCode;
    }
}
