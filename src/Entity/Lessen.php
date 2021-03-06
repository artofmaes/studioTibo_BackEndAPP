<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LessenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"= {"path"="/lessen"}},
 *     itemOperations={"get"= {"path"="/les/{id}"}},
 *     normalizationContext={"groups"={"lessen:read"}}
 * )
 * @ORM\Entity(repositoryClass=LessenRepository::class)
 */
class Lessen
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"lessen:read"})
     */
    private $datum;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"lessen:read"})
     */
    private $klasgroep;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"lessen:read"})
     */
    private $locatie;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"lessen:read"})
     */
    private $adres;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"lessen:read"})
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"lessen:read"})
     */
    private $gemeente;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="les")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"lessen:read"})
     */
    private $userId;

    /**
     * @ORM\Column(type="time")
     */
    private $startUur;

    /**
     * @ORM\Column(type="time")
     */
    private $eindUur;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatum(): ?string
    {
        return $this->datum;
    }

    public function setDatum(string $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getKlasgroep(): ?string
    {
        return $this->klasgroep;
    }

    public function setKlasgroep(string $klasgroep): self
    {
        $this->klasgroep = $klasgroep;

        return $this;
    }

    public function getLocatie(): ?string
    {
        return $this->locatie;
    }

    public function setLocatie(string $locatie): self
    {
        $this->locatie = $locatie;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getGemeente(): ?string
    {
        return $this->gemeente;
    }

    public function setGemeente(string $gemeente): self
    {
        $this->gemeente = $gemeente;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getStartUur(): ?\DateTimeInterface
    {
        return $this->startUur;
    }

    public function setStartUur(\DateTimeInterface $startUur): self
    {
        $this->startUur = $startUur;

        return $this;
    }

    public function getEindUur(): ?\DateTimeInterface
    {
        return $this->eindUur;
    }

    public function setEindUur(\DateTimeInterface $eindUur): self
    {
        $this->eindUur = $eindUur;

        return $this;
    }
}
