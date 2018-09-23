<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 1:48 PM
 */

namespace Cottect\Repository;

use Cottect\Entity\OauthClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class OauthClientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OauthClient::class);
    }

    /**
     * @param $grantTypes
     * @param $name
     * @param $description
     * @param $secret
     * @param UserInterface $user
     *
     * @return OauthClient
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(array $grantTypes, string $name, $description, $secret, $user)
    {
        $oauthClient = new OauthClient();
        $oauthClient->setGrantTypes($grantTypes);
        $oauthClient->setName($name);
        $oauthClient->setSecret($secret);
        if (!empty($description)) {
            $oauthClient->setDescription($description);
        }
        if (!empty($user)) {
            $oauthClient->setUser($user);
        }
        $this->getEntityManager()->persist($oauthClient);
        $this->getEntityManager()->flush();

        return $oauthClient;
    }
}
