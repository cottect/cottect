<?php

namespace Cottect\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cottect\Repository\PageRepository")
 * @ORM\Table(name="cot_page")
 * @ORM\HasLifecycleCallbacks
 */
class Page
{
    const STATUS_ACTIVE = 1;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @var PageCategory
     *
     * @ORM\ManyToOne(targetEntity="Cottect\Entity\PageCategory", inversedBy="page")
     */
    private $category;

    /**
     * @var Resource
     *
     * @ORM\OneToOne(targetEntity="Cottect\Entity\Resource", cascade={"persist", "remove"})
     */
    private $cover;

    /**
     * @var Resource
     *
     * @ORM\OneToOne(targetEntity="Cottect\Entity\Resource", cascade={"persist", "remove"})
     */
    private $avatar;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Cottect\Entity\Article", mappedBy="page")
     */
    private $articles;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Cottect\Entity\User", inversedBy="page")
     * @ORM\JoinTable(name="cot_page_user")
     */
    private $users;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
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
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return PageCategory
     */
    public function getCategory(): PageCategory
    {
        return $this->category;
    }

    /**
     * @param PageCategory $category
     */
    public function setCategory(PageCategory $category): void
    {
        $this->category = $category;
    }

    /**
     * @return Resource
     */
    public function getCover(): Resource
    {
        return $this->cover;
    }

    /**
     * @param Resource $cover
     */
    public function setCover(Resource $cover): void
    {
        $this->cover = $cover;
    }

    /**
     * @return Resource
     */
    public function getAvatar(): Resource
    {
        return $this->avatar;
    }

    /**
     * @param Resource $avatar
     */
    public function setAvatar(Resource $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return array
     */
    public function getArticles(): array
    {
        return $this->articles;
    }

    /**
     * @param array $articles
     */
    public function setArticles(array $articles): void
    {
        $this->articles = $articles;
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param array $users
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
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
