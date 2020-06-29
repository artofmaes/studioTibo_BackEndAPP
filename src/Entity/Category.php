<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"={"path"="/category/{id}"}},
 *
 *
 * )
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @Vich\Uploadable
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
     * @Groups("works:read")
     */
    private $catName;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $catImg;

    /**
     * @Vich\UploadableField(mapping="works", fileNameProperty="catImg")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\ManyToMany(targetEntity=Works::class, mappedBy="category")
     * @Groups({"category:read"})
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

    public function setCatImg(?string $catImg): self
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

    public function setImageFile(File $catImg = null)
    {
        $this->imageFile = $catImg;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($catImg) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getCatName();
    }
}
