<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EventsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"= {"path"="/event/{id}"}}
 * )
 * @ORM\Entity(repositoryClass=EventsRepository::class)
 */
class Events
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
    private $img;

    /**
     * @ORM\Column(type="text")
     */
    private $beschrijving;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adres;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $locatie;

    /**
     * @ORM\Column(type="datetime")
     */
    private $eventStart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $eventEnd;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     */
    private $deletedAt;

    /**
     * @ORM\Column(type="boolean")
     *
     */
    private $isDeleted = false;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="event")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $userId;

    public function __construct()
    {
        $this->userId = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();

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
        $this->updatedAt = new \DateTimeImmutable();
        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;
        $this->updatedAt = new \DateTimeImmutable();
        return $this;
    }

    public function getBeschrijving(): ?string
    {
        return $this->beschrijving;
    }

    public function setBeschrijving(string $beschrijving): self
    {
        $this->beschrijving = $beschrijving;
        $this->updatedAt = new \DateTimeImmutable();
        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        $this->updatedAt = new \DateTimeImmutable();
        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(string $adres): self
    {
        $this->adres = $adres;
        $this->updatedAt = new \DateTimeImmutable();
        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;
        $this->updatedAt = new \DateTimeImmutable();
        return $this;
    }

    public function getLocatie(): ?string
    {
        return $this->locatie;
    }

    public function setLocatie(string $locatie): self
    {
        $this->locatie = $locatie;
        $this->updatedAt = new \DateTimeImmutable();
        return $this;
    }

    public function getEventStart(): ?\DateTimeInterface
    {
        return $this->eventStart;
    }

    public function setEventStart(\DateTimeInterface $eventStart): self
    {
        $this->eventStart = $eventStart;
        $this->updatedAt = new \DateTimeImmutable();
        return $this;
    }

    public function getEventEnd(): ?\DateTimeInterface
    {
        return $this->eventEnd;
    }

    public function setEventEnd(\DateTimeInterface $eventEnd): self
    {
        $this->eventEnd = $eventEnd;
        $this->updatedAt = new \DateTimeImmutable();
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

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->userId;
    }
}
