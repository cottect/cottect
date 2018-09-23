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

class UserCheckpointService
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
     * @param $user
     * @param $verifiedBy
     *
     * @return User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function verified($user, $verifiedBy)
    {
        return $this->userRepository->verified($user, $verifiedBy);
    }
}
