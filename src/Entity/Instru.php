<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Instru
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\InstruRepository")
 * @Table(name="instrument")
 *
 */
class Instru
{
    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $users;
    public function __construct() {
        $this->users = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $IdInstru;

    /**
     * @ORM\Column(type="string", unique=true)
     *
     */
    private $instruName;



    /**
     * @return mixed
     */
    public function getIdInstru()
    {
        return $this->IdInstru;
    }


    /**
     * @return mixed
     */
    public function getInstruName()
    {
        return $this->instruName;
    }

    /**
     * @param mixed $instruName
     */
    public function setInstruName($instruName)
    {
        $this->instruName = $instruName;
    }

}