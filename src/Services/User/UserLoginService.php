<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/5/18
 * Time: 10:56 AM
 */

namespace Cottect\Services\User;

use Cottect\Entity\User;
use Cottect\Http\Response;
use Cottect\Repository\UserRepository;
use Cottect\Utils\Detect;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserLoginService
{
    protected $username;
    protected $password;

    protected $detect;
    protected $passwordEncoder;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(
        Detect $detect,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->detect = $detect;
        $this->userRepository = $entityManager->getRepository(User::class);
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param $username
     * @param $password
     *
     * @return string | User
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function submit($username, $password)
    {
        $this->detect->setData($username);
        $user = $this->userRepository->loadUserByUsername($username);
        if (!$user) {
            return Response::INVALID_USERNAME;
        }
        $isValid = $this->passwordEncoder->isPasswordValid($user, $password);
        if (!$isValid) {
            return Response::INVALID_PASSWORD;
        }

        return $user;
    }
}
