<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SectionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"={"path"="/section/{id}"}}
 * )
 * @ORM\Entity(repositoryClass=SectionsRepository::class)
 */
class Sections
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $h1Titel;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="section")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\ManyToMany(targetEntity=Pagina::class, inversedBy="sections")
     */
    private $pagina;

    /**
     * @ORM\OneToMany(targetEntity=Textfield::class, mappedBy="sectionId", orphanRemoval=true)
     */
    private $textfield;

    public function __construct()
    {
        $this->userId = new ArrayCollection();
        $this->pagina = new ArrayCollection();
        $this->textfield = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->isDeleted = false;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getH1Titel(): ?string
    {
        return $this->h1Titel;
    }

    public function setH1Titel(string $h1Titel): self
    {
        $this->h1Titel = $h1Titel;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }


    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

//    public function getUserId(): ?User
//    {
//        return $this->userId;
//    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return Collection|Pagina[]
     */
    public function getPagina(): Collection
    {
        return $this->pagina;
    }

    public function addPagina(Pagina $pagina): self
    {
        if (!$this->pagina->contains($pagina)) {
            $this->pagina[] = $pagina;
        }

        return $this;
    }

    public function removePagina(Pagina $pagina): self
    {
        if ($this->pagina->contains($pagina)) {
            $this->pagina->removeElement($pagina);
        }

        return $this;
    }

    /**
     * @return Collection|Textfield[]
     */
    public function getTextfield(): Collection
    {
        return $this->textfield;
    }

    public function addTextfield(Textfield $textfield): self
    {
        if (!$this->textfield->contains($textfield)) {
            $this->textfield[] = $textfield;
            $textfield->setSectionId($this);
        }

        return $this;
    }

    public function removeTextfield(Textfield $textfield): self
    {
        if ($this->textfield->contains($textfield)) {
            $this->textfield->removeElement($textfield);
            // set the owning side to null (unless already changed)
            if ($textfield->getSectionId() === $this) {
                $textfield->setSectionId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getNaam();
    }
}
