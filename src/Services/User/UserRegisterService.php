<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/5/18
 * Time: 11:17 AM
 */

namespace Cottect\Services\User;

use Cottect\Entity\User;
use Cottect\Http\Request\Frontend\User\UserRegisterFrontendRequest;
use Cottect\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Translation\TranslatorInterface;

abstract class UserRegisterService implements UserRegisterServiceInterface
{
    /**
     * @var UserRegisterFrontendRequest
     */
    private $registerRequest;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    protected $translator;

    protected $passwordEncoder;

    /**
     * @var int
     */
    private $verifyCode;

    public function __construct(
        EntityManagerInterface $entityManager,
        TranslatorInterface $translator,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->userRepository = $entityManager->getRepository(User::class);
        $this->translator = $translator;
        $this->userRepository->setPasswordEncoder($passwordEncoder);
        $this->verifyCode = mt_rand(100000, 999999);
    }

    /**
     * @return UserRegisterFrontendRequest
     */
    public function getRegisterRequest(): UserRegisterFrontendRequest
    {
        return $this->registerRequest;
    }

    /**
     * @param UserRegisterFrontendRequest $registerRequest
     */
    public function setRegisterRequest(UserRegisterFrontendRequest $registerRequest): void
    {
        $this->registerRequest = $registerRequest;
    }

    /**
     * @return int
     */
    public function getVerifyCode()
    {
        return $this->verifyCode;
    }
}
