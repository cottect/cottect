<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/6/18
 * Time: 12:53 PM
 */

namespace Cottect\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cottect\Repository\CountryRepository")
 * @ORM\Table(name="cot_country")
 * @ORM\HasLifecycleCallbacks
 */
class Country
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $twoDigitCode;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $threeDigitCode;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $numericCode;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $phoneNumberCode;

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
     * @return mixed
     */
    public function getTwoDigitCode()
    {
        return $this->twoDigitCode;
    }

    /**
     * @param mixed $twoDigitCode
     */
    public function setTwoDigitCode($twoDigitCode): void
    {
        $this->twoDigitCode = $twoDigitCode;
    }

    /**
     * @return mixed
     */
    public function getThreeDigitCode()
    {
        return $this->threeDigitCode;
    }

    /**
     * @param mixed $threeDigitCode
     */
    public function setThreeDigitCode($threeDigitCode): void
    {
        $this->threeDigitCode = $threeDigitCode;
    }

    /**
     * @return mixed
     */
    public function getNumericCode()
    {
        return $this->numericCode;
    }

    /**
     * @param mixed $numericCode
     */
    public function setNumericCode($numericCode): void
    {
        $this->numericCode = $numericCode;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumberCode()
    {
        return $this->phoneNumberCode;
    }

    /**
     * @param mixed $phoneNumberCode
     */
    public function setPhoneNumberCode($phoneNumberCode): void
    {
        $this->phoneNumberCode = $phoneNumberCode;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime | null
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @ORM\PreUpdate
     * @param \DateTime $updated
     */
    public function setUpdated(\DateTime $updated): void
    {
        $this->updated = $updated;
    }
}
