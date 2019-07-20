<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cottect\Repository;

use Cottect\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * This custom Doctrine repository is empty because so far we don't need any custom
 * method to query for application user information. But it's always a good practice
 * to define a custom repository that will be used when the application grows.
 *
 * See https://symfony.com/doc/current/doctrine/repository.html
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class UserRepository extends EntityRepository implements UserLoaderInterface
{
    /**
     * @var UserPasswordEncoderInterface
     */
    protected $passwordEncoder;

    /**
     * UserRepository constructor.
     *
     * @param $em
     * @param Mapping\ClassMetadata $class
     */
    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }

    /**
     * @param $id
     *
     * @return User|mixed
     */
    public function findOneById($id)
    {
        return $this->find($id);
    }

    /**
     * @param string $username
     *
     * @return mixed|null|User
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.phone = :phone OR u.email = :email')
            ->setParameter('phone', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByPhone($phone)
    {
        return $this->findBy(
            [
                'phone' => $phone,
            ]
        );
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function findByEmail($email)
    {
        return $this->findOneBy(
            [
                'email' => $email,
            ]
        );
    }

    /**
     * @param $firstName
     * @param $lastName
     * @param $phone
     * @param $plainPassword
     * @param $birthday
     * @param $gender
     * @param $verifyCode
     *
     * @return User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createByPhone($firstName, $lastName, $phone, $plainPassword, $birthday, $gender, $verifyCode)
    {
        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setPhone($phone);
        $user->setBirthday($birthday);
        $user->setGender($gender);
        $user->setVerifyCode($verifyCode);
        $encodedPassword = $this->getPasswordEncoder()->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    /**
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $plainPassword
     * @param $birthday
     * @param $gender
     * @param $verifyCode
     *
     * @return User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createByEmail($firstName, $lastName, $email, $plainPassword, $birthday, $gender, $verifyCode)
    {
        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);
        $user->setBirthday($birthday);
        $user->setGender($gender);
        $user->setVerifyCode($verifyCode);
        $encodedPassword = $this->getPasswordEncoder()->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    /**
     * @return UserPasswordEncoderInterface
     */
    public function getPasswordEncoder(): UserPasswordEncoderInterface
    {
        return $this->passwordEncoder;
    }

    /**
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function setPasswordEncoder(UserPasswordEncoderInterface $passwordEncoder): void
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param User $userObject
     *
     * @param $verifiedBy
     *
     * @return User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function verified(User $userObject, $verifiedBy)
    {
        $user = $this->findOneById($userObject->getId());
        $user->setVerified(new \DateTime());
        $user->setVerifiedBy($verifiedBy);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }
}
