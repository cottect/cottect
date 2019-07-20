<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/6/18
 * Time: 2:00 PM
 */

namespace Cottect\Services\User;

use Cottect\Entity\User;
use Cottect\Http\Request\Frontend\User\UserRegisterFrontendRequest;
use Cottect\Utils\Detect;

class UserRegisterFactoryService
{
    const BY_PHONE = 'phone';
    const BY_EMAIL = 'email';

    /**
     * @var UserRegisterServiceInterface
     */
    private $registerService;

    /**
     * @var UserRegisterByPhoneService
     */
    private $registerByPhoneService;

    /**
     * @var UserRegisterByEmailService
     */
    private $registerByEmailService;

    private $detect;

    /**
     * UserRegisterFactoryService constructor.
     *
     * @param UserRegisterByPhoneService $registerByPhoneService
     * @param UserRegisterByEmailService $registerByEmailService
     * @param Detect $detect
     */
    public function __construct(
        UserRegisterByPhoneService $registerByPhoneService,
        UserRegisterByEmailService $registerByEmailService,
        Detect $detect
    )
    {
        $this->registerByPhoneService = $registerByPhoneService;
        $this->registerByEmailService = $registerByEmailService;
        $this->detect = $detect;
    }

    /**
     * @param UserRegisterFrontendRequest $request
     *
     * @return User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(UserRegisterFrontendRequest $request)
    {
        $this->detect->setData($request->getUsername());
        if ($this->detect->isPhone()) {
            $type = self::BY_PHONE;
        } else {
            $type = self::BY_EMAIL;
        }
        $registerService = $this->make($type);
        $registerService->setRegisterRequest($request);
        $user = $registerService->submit();

        return $user;
    }

    /**
     * @param $type
     *
     * @return UserRegisterServiceInterface
     */
    private function make($type)
    {
        switch ($type) {
            case self::BY_PHONE:
                $this->registerService = $this->registerByPhoneService;
                break;
            case self::BY_EMAIL:
                $this->registerService = $this->registerByEmailService;
        }

        return $this->registerService;
    }
}
