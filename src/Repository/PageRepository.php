<?php

namespace Cottect\Repository;

use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository
{
    /**
     * @param $page
     *
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create($page)
    {
        $this->getEntityManager()->persist($page);
        $this->getEntityManager()->flush();

        return $page;
    }
}
