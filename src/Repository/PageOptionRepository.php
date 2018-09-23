<?php

namespace Cottect\Repository;

use Cottect\Entity\PageOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PageOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageOption[]    findAll()
 * @method PageOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageOptionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PageOption::class);
    }
}
