<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/5/18
 * Time: 11:19 AM
 */

namespace Cottect\Services\User;

use Cottect\Entity\User;
use Cottect\Http\Request\Frontend\User\UserRegisterFrontendRequest;

interface UserRegisterServiceInterface
{
    public function setRegisterRequest(UserRegisterFrontendRequest $request);

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @return User
     */
    public function submit();
}
