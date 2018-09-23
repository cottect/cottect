<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/18/18
 * Time: 10:14 PM
 */

namespace Cottect\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cottect\Repository\OauthTokenRepository")
 * @ORM\Table(name="cot_oauth_token")
 * @ORM\HasLifecycleCallbacks
 */
class OauthToken
{
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
     * @ORM\ManyToOne(targetEntity="Cottect\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Cottect\Entity\OauthClient")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $oauthClient;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $expiresIn;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $revoked;

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
     * @return mixed
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
     * @return mixed
     */
    public function getOauthClient()
    {
        return $this->oauthClient;
    }

    /**
     * @param mixed $oauthClient
     */
    public function setOauthClient($oauthClient): void
    {
        $this->oauthClient = $oauthClient;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresIn(): \DateTime
    {
        return $this->expiresIn;
    }

    /**
     * @param \DateTime $expiresIn
     */
    public function setExpiresIn(\DateTime $expiresIn): void
    {
        $this->expiresIn = $expiresIn;
    }

    /**
     * @return \DateTime
     */
    public function getRevoked(): \DateTime
    {
        return $this->revoked;
    }

    /**
     * @param \DateTime $revoked
     */
    public function setRevoked(\DateTime $revoked): void
    {
        $this->revoked = $revoked;
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
