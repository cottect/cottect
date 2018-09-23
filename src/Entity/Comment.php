<?php

namespace Cottect\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cottect\Repository\CommentRepository")
 * @ORM\Table(name="cot_comment")
 */
class Comment
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @var integer
     * @ORM\Column(type="smallint", options={"comment":"0:not public, 1:public, 2:deleted"})
     */
    private $status;

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
     * @var $this
     * @ORM\OneToOne(targetEntity="Cottect\Entity\Comment", cascade={"persist", "remove"})
     */
    private $parent;

    /**
     * @var Article
     * @ORM\ManyToOne(targetEntity="Cottect\Entity\Article", inversedBy="comment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Cottect\Entity\User", inversedBy="comment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
}
