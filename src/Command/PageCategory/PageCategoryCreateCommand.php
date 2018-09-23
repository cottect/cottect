<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 4:07 PM
 */

namespace Cottect\Command\PageCategory;

use Cottect\Services\PageCategory\PageCategoryCreateService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class PageCategoryCreateCommand extends Command
{
    public static $defaultName = 'cottect:page-category:create';

    /**
     * @var PageCategoryCreateService
     */
    private $pageCategoryCreateService;

    public function __construct(PageCategoryCreateService $pageCategoryCreateService)
    {
        parent::__construct(self::$defaultName);
        $this->pageCategoryCreateService = $pageCategoryCreateService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a new page category')
            ->setHelp('This command allows you to create new page category');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $questionName = new Question('Please enter the name of the page category: ');
        $questionName->setValidator(function ($answer) {
            if (empty($answer)) {
                throw new \RuntimeException(
                    'The name of the client must not empty'
                );
            }

            return $answer;
        });
        $questionName->setMaxAttempts(3);
        $name = $helper->ask($input, $output, $questionName);
        $questionDescription = new Question('Please enter the description of the page category: ', null);
        $description = $helper->ask($input, $output, $questionDescription);
        $pageCategory = $this->pageCategoryCreateService->create($name, $description);
        $table = new Table($output);
        $table
            ->setHeaders(
                array('id', 'name', 'description', 'created')
            )
            ->setRows(
                array(
                    array(
                        $pageCategory->getId(),
                        $pageCategory->getName(),
                        $pageCategory->getDescription(),
                        date('Y-m-d H:i:s', $pageCategory->getCreated()->getTimestamp()),
                    ),
                )
            );
        $table->render();
    }
}
