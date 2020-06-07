<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TextfieldRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"={"path"="/textfield/{id}"}},
 *     normalizationContext={"groups"={"textfield:read"}}
 * )
 * @ORM\Entity(repositoryClass=TextfieldRepository::class)
 * @Vich\Uploadable
 */
class Textfield
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"textfield:read"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"textfield:read"})
     */
    private $tekst;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"textfield:read"})
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"textfield:read"})
     */
    private $image;


    /**
     * @Vich\UploadableField(mapping="works", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $UpdatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted;

    /**
     * @ORM\ManyToOne(targetEntity=Sections::class, inversedBy="textfield")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"textfield:read"})
     */
    private $sectionId;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->isDeleted = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTekst(): ?string
    {
        return $this->tekst;
    }

    public function setTekst(?string $tekst): self
    {
        $this->tekst = $tekst;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }


    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
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


    public function getSectionId(): ?Sections
    {
        return $this->sectionId;
    }

    public function setSectionId(?Sections $sectionId): self
    {
        $this->sectionId = $sectionId;

        return $this;
    }

    public function setImageFile(File $image= null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
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
        return (string) $this->getTitle();
    }
}
