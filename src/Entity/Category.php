<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *
 * )
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $catName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $catImg;

    /**
     * @ORM\ManyToMany(targetEntity=Works::class, mappedBy="category")
     */
    private $workId;

    public function __construct()
    {
        $this->workId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatName(): ?string
    {
        return $this->catName;
    }

    public function setCatName(string $catName): self
    {
        $this->catName = $catName;

        return $this;
    }

    public function getCatImg(): ?string
    {
        return $this->catImg;
    }

    public function setCatImg(string $catImg): self
    {
        $this->catImg = $catImg;

        return $this;
    }

    /**
     * @return Collection|Works[]
     */
    public function getWorkId(): Collection
    {
        return $this->workId;
    }

    public function addWorkId(Works $workId): self
    {
        if (!$this->workId->contains($workId)) {
            $this->workId[] = $workId;
            $workId->addCategory($this);
        }

        return $this;
    }

    public function removeWorkId(Works $workId): self
    {
        if ($this->workId->contains($workId)) {
            $this->workId->removeElement($workId);
            $workId->removeCategory($this);
        }

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getCatName();
    }
}
