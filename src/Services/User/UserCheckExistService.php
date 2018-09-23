<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/6/18
 * Time: 10:24 PM
 */

namespace Cottect\Services\User;

use Cottect\Entity\User;
use Cottect\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserCheckExistService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->userRepository = $entityManager->getRepository(User::class);
    }

    public function byEmail($email)
    {
        $user = $this->userRepository->findByEmail($email);
        if ($user) {
            return true;
        }

        return false;
    }

    public function byPhone($phone)
    {
        if ($this->userRepository->findByPhone($phone)) {
            return true;
        }
        return false;
    }
}
