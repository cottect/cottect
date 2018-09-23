<?php

namespace Cottect\Repository;

use Cottect\Entity\Voting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Voting|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voting|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voting[]    findAll()
 * @method Voting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VotingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Voting::class);
    }
}
