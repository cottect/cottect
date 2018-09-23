<?php

namespace Cottect\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cottect\Repository\ResourceRepository")
 * @ORM\Table(name="cot_resource")
 * @ORM\HasLifecycleCallbacks
 */
class Resource
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidOrderedTimeGenerator")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="smallint", nullable=true, options={"comment":"image, video, audio, file"})
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Cottect\Entity\User", inversedBy="resource")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $uri;

    /**
     * @var string
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $host;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $size;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

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
