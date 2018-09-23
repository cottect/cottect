<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 9:50 AM
 */

namespace Cottect\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cottect\Repository\OauthClientRepository")
 * @ORM\Table(name="cot_oauth_client")
 * @ORM\HasLifecycleCallbacks
 */
class OauthClient
{
    const GRANT_TYPE_AUTHORIZATION_CODE = 'authorization_code';
    const GRANT_TYPE_PASSWORD = 'password';
    const GRANT_TYPE_REGISTER = 'register';
    const GRANT_TYPE_REFRESH_TOKEN = 'refresh_token';
    const GRANT_TYPE_IMPLICIT = 'implicit';

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidOrderedTimeGenerator")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $secret;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $redirectUri;

    /**
     * @var array
     * @ORM\Column(type="array", length=255, nullable=false)
     */
    protected $grantTypes;

    /**
     * @ORM\ManyToOne(targetEntity="Cottect\Entity\User", inversedBy="client")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updated;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string | null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string | null
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @param string $redirectUri
     */
    public function setRedirectUri(string $redirectUri): void
    {
        $this->redirectUri = $redirectUri;
    }

    /**
     * @return array
     */
    public function getGrantTypes(): array
    {
        return $this->grantTypes;
    }

    /**
     * @param array $grantTypes
     */
    public function setGrantTypes(array $grantTypes): void
    {
        $this->grantTypes = $grantTypes;
    }

    /**
     * @return User | null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @ORM\PrePersist
     *
     * @return $this
     */
    public function setCreated()
    {
        $this->created = new \DateTime();

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdated(): ?\DateTime
    {
        return $this->updated;
    }

    /**
     * @ORM\PreUpdate
     *
     * @return $this
     */
    public function setUpdated()
    {
        $this->updated = new \DateTime();

        return $this;
    }
}
