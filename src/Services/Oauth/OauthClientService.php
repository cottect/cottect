<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 2:32 PM
 */

namespace Cottect\Services\Oauth;

use Cottect\Entity\OauthClient;
use Cottect\Repository\OauthClientRepository;
use Cottect\Utils\Random;
use Doctrine\ORM\EntityManagerInterface;

class OauthClientService
{
    /**
     * @var OauthClientRepository
     */
    protected $oauthClientRepository;

    /**
     * @var Random
     */
    protected $random;

    /**
     * OauthClientService constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param Random $random
     */
    public function __construct(EntityManagerInterface $entityManager, Random $random)
    {
        $this->oauthClientRepository = $entityManager->getRepository(OauthClient::class);
        $this->random = $random;
    }

    /**
     * @return array
     */
    public function getGrantTypeSupported()
    {
        return [
            OauthClient::GRANT_TYPE_REGISTER,
            OauthClient::GRANT_TYPE_PASSWORD,
            OauthClient::GRANT_TYPE_REFRESH_TOKEN,
        ];
    }

    /**
     * @param $grantType
     * @param $name
     * @param $description
     * @param null $user
     *
     * @return OauthClient
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create($grantType, $name, $description, $user = null)
    {
        $secret = $this->random->generateToken();

        return $this->oauthClientRepository->create($grantType, $name, $description, $secret, $user);
    }

    /**
     * @param $clientId
     *
     * @return OauthClient | mixed
     */
    public function getById($clientId)
    {
        return $this->oauthClientRepository->find($clientId);
    }
}
