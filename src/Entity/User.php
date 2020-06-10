<?php

namespace App\Entity;


use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

//@ApiResource(
// *     accessControl = "is_granted('ROLE_USER')",
// *     collectionOperations={
//    *     "get" ,
// *     "post" = {
//        *     "security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')",
// *     "validation_groups" = {"Default", "create"}
// *     }
// *     },
// *     itemOperations={
//    *     "get",
// *     "put" = {"security"="is_granted('ROLE_USER') and object == user"},
// *     "delete"= {"security"="is_granted('ROLE_ADMIN')"}
// *     },
// *     normalizationContext={"groups"={"user:read"}},
// *     denormalizationContext={"groups"={"user:write"}}
// * )

/**
 *
 * @ORM\Entity(repositoryClass=UserRepository::class)
 *
 * @UniqueEntity(fields={"email"})
 *
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
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     *
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     *
     */
    private $password;

    /**
     *
     * @SerializedName("password")
     * @Assert\NotBlank(groups={"create"})
     */
    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity=Works::class, mappedBy="userId", orphanRemoval=true)
     */
    private $work;

    /**
     * @ORM\OneToMany(targetEntity=Events::class, mappedBy="userId", orphanRemoval=true)
     */
    private $event;

    /**
     * @ORM\OneToMany(targetEntity=Lessen::class, mappedBy="userId", orphanRemoval=true)
     */
    private $les;

    /**
     * @ORM\OneToMany(targetEntity=Sections::class, mappedBy="userId", orphanRemoval=true)
     */
    private $section;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $naam;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $voornaam;

    public function __construct()
    {
        $this->roles[] = 'ROLE_USER';
        $this->work = new ArrayCollection();
        $this->event = new ArrayCollection();
        $this->les = new ArrayCollection();
        $this->section = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    /**
     * @return Collection|Works[]
     */
    public function getWork(): Collection
    {
        return $this->work;
    }

    public function addWork(Works $work): self
    {
        if (!$this->work->contains($work)) {
            $this->work[] = $work;
            $work->setUserId($this);
        }

        return $this;
    }

    public function removeWork(Works $work): self
    {
        if ($this->work->contains($work)) {
            $this->work->removeElement($work);
            // set the owning side to null (unless already changed)
            if ($work->getUserId() === $this) {
                $work->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Events[]
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(Events $event): self
    {
        if (!$this->event->contains($event)) {
            $this->event[] = $event;
            $event->setUserId($this);
        }

        return $this;
    }

    public function removeEvent(Events $event): self
    {
        if ($this->event->contains($event)) {
            $this->event->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getUserId() === $this) {
                $event->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lessen[]
     */
    public function getLes(): Collection
    {
        return $this->les;
    }

    public function addLe(Lessen $le): self
    {
        if (!$this->les->contains($le)) {
            $this->les[] = $le;
            $le->setUserId($this);
        }

        return $this;
    }

    public function removeLe(Lessen $le): self
    {
        if ($this->les->contains($le)) {
            $this->les->removeElement($le);
            // set the owning side to null (unless already changed)
            if ($le->getUserId() === $this) {
                $le->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sections[]
     */
    public function getSection(): Collection
    {
        return $this->section;
    }

    public function addSection(Sections $section): self
    {
        if (!$this->section->contains($section)) {
            $this->section[] = $section;
            $section->setUserId($this);
        }

        return $this;
    }

    public function removeSection(Sections $section): self
    {
        if ($this->section->contains($section)) {
            $this->section->removeElement($section);
            // set the owning side to null (unless already changed)
            if ($section->getUserId() === $this) {
                $section->setUserId(null);
            }
        }

        return $this;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getVoornaam(): ?string
    {
        return $this->voornaam;
    }

    public function setVoornaam(string $voornaam): self
    {
        $this->voornaam = $voornaam;

        return $this;
    }



    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }


    public function setPlainPassword($plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->voornaam;
    }
}
