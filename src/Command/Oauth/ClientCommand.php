<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 4:07 PM
 */

namespace Cottect\Command\Oauth;

use Cottect\Services\Oauth\OauthClientService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class ClientCommand extends Command
{
    public static $defaultName = 'cottect:oauth:client:create';

    /**
     * @var OauthClientService
     */
    private $clientService;

    public function __construct(OauthClientService $clientService)
    {
        parent::__construct(self::$defaultName);
        $this->clientService = $clientService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a new client')
            ->setHelp('This command allows you to create new client');
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
        $questionGrantType = new ChoiceQuestion(
            'Please select grant type (defaults to password): ',
            $this->clientService->getGrantTypeSupported(),
            '0,1,2'
        );
        $questionGrantType->setMultiselect(true);
        $questionGrantType->setErrorMessage('Grant type %s is invalid.');
        $grantType = $helper->ask($input, $output, $questionGrantType);
        $questionName = new Question('Please enter the name of the client: ');
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
        $questionDescription = new Question('Please enter the description of the client: ', null);
        $description = $helper->ask($input, $output, $questionDescription);
        $client = $this->clientService->create($grantType, $name, $description);
        $table = new Table($output);
        $table
            ->setHeaders(
                array('id', 'secret', 'user_id', 'name', 'description', 'redirect_uri', 'grant_type', 'created')
            )
            ->setRows(
                array(
                    array(
                        $client->getId(),
                        $client->getSecret(),
                        !empty($client->getUser()) ? $client->getUser()->getId() : null,
                        $client->getName(),
                        $client->getDescription(),
                        $client->getRedirectUri(),
                        json_encode($client->getGrantTypes()),
                        date('Y-m-d H:i:s', $client->getCreated()->getTimestamp()),
                    ),
                )
            );
        $table->render();
    }
}
