<?php

namespace Cottect\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cottect\Repository\VotingRepository")
 * @ORM\Table(name="cot_voting")
 * @ORM\HasLifecycleCallbacks
 */
class Voting
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
     * @ORM\Column(type="smallint", options={"comment":"1:Page, 2:Comment, 3:Article"})
     */
    private $type;

    /**
     * @ORM\Column(type="smallint", options={"comment":"1:upvote, -1:downvote"})
     */
    private $number;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="Cottect\Entity\User", inversedBy="voting")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=36)
     */
    private $object;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setObject(string $object): self
    {
        $this->object = $object;

        return $this;
    }

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
