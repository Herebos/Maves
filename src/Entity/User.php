<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="Ce nom est déjà pris")
 * @UniqueEntity(fields={"Mail"}, message="Mail déjà utilisez, essayez de vous connecter")
 * @Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
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
     * @ORM\Column (type="string", length=35)
     * @Groups("main")
     * One user has many instrument. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Instru", mappedBy="user", cascade={"persist"})
     * @JoinColumn(name="IdInstrument", referencedColumnName="idInstru")
     */
    private $instruments;

    /**
     * @ORM\Column (type="string", length=35)
     * @Groups("main")
     * One user has many style. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Style", mappedBy="user", cascade={"persist"})
     * @JoinColumn(name="IdStyle", referencedColumnName="idStyle")
     */
    private $styles;


    /**
     * @ORM\Column (type="boolean", length=1)
     * @Groups("main")
     */
    private $groupe;


    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $agreedTermsAt;



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
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
        $roles[] = 'ROLE_USER';

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

    public function getInstruments(): string {
        return (string) $this->instruments;
    }

    /**
     * @param $instruments
     * @return self
     */
    public function setInstruments($instruments) {
        $this->instruments[] = $instruments;
        return $this;
    }

    public function getStyles(): string {
        return (string) $this->styles;
    }

    /**
     * @param $styles
     * @return self
     */
    public function setStyles($styles) {
        $this->styles[] = $styles;
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
}
