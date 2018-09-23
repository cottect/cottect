<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 6/3/18
 * Time: 12:28 PM
 */

namespace Cottect\Services\PageCategory;

use Cottect\Entity\PageCategory;
use Cottect\Repository\PageCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class PageCategoryCreateService
{
    /**
     * @var PageCategoryRepository
     */
    private $pageCategoryRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->pageCategoryRepository = $entityManager->getRepository(PageCategory::class);
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
        $pageCategory = $this->pageCategoryRepository->create($name, $description);

        return $pageCategory;
    }
}
