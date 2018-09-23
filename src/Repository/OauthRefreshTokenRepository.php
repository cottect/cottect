<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 1:47 PM
 */

namespace Cottect\Repository;

use Cottect\Entity\OauthRefreshToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class OauthRefreshTokenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OauthRefreshToken::class);
    }
}
