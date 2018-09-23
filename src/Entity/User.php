<?php

namespace Cottect\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="Cottect\Repository\UserRepository")
 * @ORM\Table(name="cot_user")
 * @ORM\HasLifecycleCallbacks
 */
class User implements UserInterface
{
    const MALE = 'male';
    const FEMALE = 'female';

    const EMAIL = 'email';
    const PHONE = 'phone';

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $phone;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $password;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $lastName;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=false, options={"comment":"yyyy-MM-dd"})
     */
    protected $birthday;

    /**
     * @var string
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    protected $gender;

    protected $street;

    protected $village;

    protected $district;

    protected $province;

    protected $city;

    protected $country;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $verifyCode;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $verifiedBy;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $verified;

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
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $deleted;

    /**
     * @ORM\OneToOne(targetEntity="Cottect\Entity\Relationship", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $relationship;

    /**
     * @ORM\OneToOne(targetEntity="Cottect\Entity\Relationship", mappedBy="friend", cascade={"persist", "remove"})
     */
    protected $friend;

    /**
     * @ORM\OneToMany(targetEntity="Cottect\Entity\Voting", mappedBy="user")
     */
    protected $voting;

    /**
     * @ORM\OneToMany(targetEntity="Cottect\Entity\Article", mappedBy="user", orphanRemoval=true)
     */
    protected $article;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Cottect\Entity\Comment", mappedBy="user", orphanRemoval=true)
     */
    protected $comment;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Cottect\Entity\Page", mappedBy="user")
     */
    protected $page;

    /**
     * @ORM\OneToMany(targetEntity="Cottect\Entity\Resource", mappedBy="user")
     */
    protected $resource;

    /**
     * @ORM\OneToMany(targetEntity="Cottect\Entity\OauthClient", mappedBy="user")
     */
    protected $client;

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $encodedPassword
     */
    public function setPassword(string $encodedPassword): void
    {
        $this->password = $encodedPassword;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday(): \DateTime
    {
        return $this->birthday;
    }

    /**
     * @param string|\DateTime $birthday
     */
    public function setBirthday($birthday): void
    {
        if ($birthday instanceof \DateTime) {
            $this->birthday = $birthday;
        } else {
            $birthdayDatetime = \DateTime::createFromFormat('Y-m-d', $birthday);
            $this->birthday = $birthdayDatetime;
        }
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return int
     */
    public function getVerifyCode(): int
    {
        return $this->verifyCode;
    }

    /**
     * @param int $verifyCode
     */
    public function setVerifyCode(int $verifyCode): void
    {
        $this->verifyCode = $verifyCode;
    }

    /**
     * @return string
     */
    public function getVerifiedBy(): string
    {
        return $this->verifiedBy;
    }

    /**
     * @param string $verifiedBy
     */
    public function setVerifiedBy(string $verifiedBy): void
    {
        $this->verifiedBy = $verifiedBy;
    }

    /**
     * @return \DateTime | null
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * @param \DateTime $verified
     */
    public function setVerified(\DateTime $verified): void
    {
        $this->verified = $verified;
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

    /**
     * @return \DateTime
     */
    public function getDeleted(): \DateTime
    {
        return $this->deleted;
    }

    /**
     * @ORM\PreRemove
     *
     * @param \DateTime $deleted
     */
    public function setDeleted(\DateTime $deleted): void
    {
        $this->deleted = $deleted;
    }
}
