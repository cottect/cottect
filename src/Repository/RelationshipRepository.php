<?php

namespace Cottect\Repository;

use Cottect\Entity\Relationship;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Relationship|null find($id, $lockMode = null, $lockVersion = null)
 * @method Relationship|null findOneBy(array $criteria, array $orderBy = null)
 * @method Relationship[]    findAll()
 * @method Relationship[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelationshipRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Relationship::class);
    }
}
