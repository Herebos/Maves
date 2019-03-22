<?php

namespace App\Entity;

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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     *
     */
    private $instruName;

    private $instrument;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
     * @return Instru
     */
    public function setInstruName($instruName)
    {
        $this->instruName = $instruName;
        return $this;
    }

    public function __toString()
    {
        return (string) $this->getInstruName();
//        return (string) $this->getStyle();
    }

    /**
     * @return mixed
     */
    public function getInstrument()
    {
        return $this->instrument;
    }

    /**
     * @param mixed $instrument
     */
    public function setInstrument($instrument)
    {
        $this->instrument = $instrument;
    }

}