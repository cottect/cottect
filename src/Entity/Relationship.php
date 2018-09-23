<?php

namespace Cottect\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cottect\Repository\RelationshipRepository")
 * @ORM\Table(name="cot_relationship")
 */
class Relationship
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
     * @ORM\Column(type="smallint", nullable=true, options={"comment":"friend, drop, unfollow"})
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity="Cottect\Entity\User", inversedBy="relationship", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="Cottect\Entity\User", inversedBy="friend", cascade={"persist", "remove"})
     */
    private $friend;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;
}
