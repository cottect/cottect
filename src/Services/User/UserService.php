<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/20/18
 * Time: 9:54 PM
 */

namespace Cottect\Services\User;

use Cottect\Entity\User;
use Cottect\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->userRepository = $entityManager->getRepository(User::class);
    }

    /**
     * @param $userId
     *
     * @return User | mixed
     */
    public function getById($userId)
    {
        return $this->userRepository->find($userId);
    }
}
