<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Style
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\StyleRepository")
 * @Table(name="style")
 */
class Style
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
     */
    private $styleName;

    private $style;

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
    public function getStyleName()
    {
        return $this->styleName;
    }

    /**
     * @param mixed $styleName
     */
    public function setStyleName($styleName)
    {
        $this->styleName = $styleName;
    }

    public function __toString()
    {
        return (string) $this->getStyleName();
    }

    /**
     * @return mixed
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param mixed $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }


}
