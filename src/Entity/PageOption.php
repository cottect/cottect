<?php

namespace Cottect\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cottect\Repository\PageOptionRepository")
 * @ORM\Table(name="cot_page_option")
 */
class PageOption
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
     * @ORM\ManyToOne(targetEntity="Cottect\Entity\Page", inversedBy="option")
     */
    private $page;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $key;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $value;
}
