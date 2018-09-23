<?php

namespace Cottect\Repository;

use Cottect\Entity\PageCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PageCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageCategory[]    findAll()
 * @method PageCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PageCategory::class);
    }

    /**
     * @param $name
     * @param $description
     *
     * @return PageCategory
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create($name, $description)
    {
        $pageCategory = new PageCategory();
        $pageCategory->setName($name);
        $pageCategory->setDescription($description);
        $this->getEntityManager()->persist($pageCategory);
        $this->getEntityManager()->flush();

        return $pageCategory;
    }
}
