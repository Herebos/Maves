<?php

namespace App\Entity;



use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\OneToMany;
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
    private $IdStyle;

    /**
     * @ORM\Column(type="string", unique=true)
     *
     */
    private $styleName;



    /**
     * @return mixed
     */
    public function getIdStyle()
    {
        return $this->IdStyle;
    }


    /**
     * @return mixed
     */
    public function getStyleName()
    {
        return $this->styleName;
    }

}
