<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 6/3/18
 * Time: 11:59 AM
 */

namespace Cottect\Services\Page;

use Cottect\Entity\Page;
use Cottect\Entity\User;
use Cottect\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;

class PageCreateService
{
    /** @var PageRepository */
    protected $pageRepository;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->pageRepository = $entityManager->getRepository(Page::class);
    }

    /**
     * @param User $user
     *
     * @return Page|mixed
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createAfterRegisterSuccessful(User $user)
    {
        $page = new Page();
        $page->setName($user->getFirstName() . " " . $user->getLastName());
        $page->setUsers([$user]);
        $page->setStatus(Page::STATUS_ACTIVE);
        $page = $this->pageRepository->create($page);

        return $page;
    }
}
