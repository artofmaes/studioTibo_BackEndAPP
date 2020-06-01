<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PaginaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"={"path"="/pagina/{id}"}}
 * )
 * @ORM\Entity(repositoryClass=PaginaRepository::class)
 */
class Pagina
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
    private $paginaNaam;

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
     * @ORM\ManyToMany(targetEntity=Sections::class, mappedBy="pagina")
     */
    private $sections;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->isDeleted = false;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaginaNaam(): ?string
    {
        return $this->paginaNaam;
    }

    public function setPaginaNaam(string $paginaNaam): self
    {
        $this->paginaNaam = $paginaNaam;

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



    /**
     * @return Collection|Sections[]
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Sections $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections[] = $section;
            $section->addPagina($this);
        }

        return $this;
    }

    public function removeSection(Sections $section): self
    {
        if ($this->sections->contains($section)) {
            $this->sections->removeElement($section);
            $section->removePagina($this);
        }

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->paginaNaam;
    }
}
