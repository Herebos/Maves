<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="Ce nom est déjà pris")
 * @UniqueEntity(fields={"Mail"}, message="Mail déjà utilisez")
 * @Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("main")
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     * @Groups("main")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Veuillez entrez un mot de passe")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=70, unique=true)
     * @Groups("main")
     * @Assert\NotBlank(message="Veuillez entrez un mail valide")
     * @Assert\Email()
     */
    private $Mail;

    /**
     * @ORM\Column (type="boolean", length=1)
     */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity="Instru")
     * @JoinColumn(name="instru_id", referencedColumnName="id")
     */
    private $instrument;

    /**
     * @ORM\ManyToOne(targetEntity="Style")
     * @JoinColumn(name="style_id", referencedColumnName="id")
     */
    private $style;

    /**
     * @ORM\Column(type="string")
     */
    private $description;



    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $agreedTermsAt;



    public function getId()
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername()
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER'; //TODO Mod here

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        $roles[] = ['ROLE_USER'];

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getGroupe() {
        return $this->groupe;
    }
    public function setGroupe($groupe) {
        $this->groupe = $groupe;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): self
    {
        $this->Mail = $Mail;

        return $this;
    }


    public function getAgreedTermsAt(): ?\DateTimeInterface
    {
        return $this->agreedTermsAt;
    }


    /**
     * @throws \Exception
     */
    public function agreeToTerms()
    {
        $this->agreedTermsAt = new \DateTime();
    }

    public function setAgreedTermsAt(\DateTimeInterface $agreedTermsAt): self
    {
        $this->agreedTermsAt = $agreedTermsAt;

        return $this;
    }

    /**
     * @return Instru
     */
    public function getInstrument()
    {
        return $this->instrument;
    }

    /**
     * @param $instrument
     */
    public function setInstrument($instrument)
    {
        $this->instrument = $instrument;
    }


    /**
     * @return Style
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }
}
