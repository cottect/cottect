<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 1:58 PM
 */

namespace Cottect\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cottect\Repository\SessionRepository")
 * @ORM\Table(name="sessions")
 */
class Session
{
    /**
     * @ORM\Id
     * @ORM\Column(name="sess_id", type="string", length=128, nullable=false)
     */
    protected $id;

    /**
     * @ORM\Column(name="sess_data", type="blob", nullable=false)
     */
    protected $data;

    /**
     * @ORM\Column(name="sess_time", type="integer", options={"unsigned"=true}, nullable=false)
     */
    protected $time;

    /**
     * @ORM\Column(name="sess_lifetime", type="integer", options={"unsigned"=true}, nullable=false)
     */
    protected $lifetime;
}
