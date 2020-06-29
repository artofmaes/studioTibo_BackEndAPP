<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Action\NotFoundAction;
use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"post"},
 *     itemOperations={"get"= {"controller"=NotFoundAction::class,"read"=false,"output"=false} }
 *
 * )
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
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
    private $email;

    /**
     * @ORM\Column(type="text")
     */
    private $vraag;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAnswered;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->isAnswered = false;
        // STANDAARD MAIL OPSTELLEN EN DOORSTUREN
        $to=$_ENV['MIJN_MAIL'];
        $subject='Iemand wilt contact opnemen!';
        $message="<html>
        <p>Dag Tibo</p>
        <p> Iemand heeft contact met jou opgenomen. Ga naar jouw dashboard bij <a href='https://wdev.be/wdev_jordi/eindwerk/?entity=Contact&action=list&menuIndex=3&submenuIndex=0'>Contact</a> om hun bericht te lezen en hen terug te mailen.</p>
        <p>Groeten</p>
        <p>Jouw Dashboard</p>
       </html>";
        $headers="From: Studio Tibo Dashboard <".$_ENV['MIJN_ZENDERMAIL'].">" . "\r\n" .
        'X-Mailer: PHP/'. phpversion() . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-type: text/html; charset=iso-8859-1';
        mail($to, $subject, $message, $headers);
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getVraag(): ?string
    {
        return $this->vraag;
    }

    public function setVraag(string $vraag): self
    {
        $this->vraag = $vraag;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getIsAnswered(): ?bool
    {
        return $this->isAnswered;
    }

    public function setIsAnswered(bool $isAnswered): self
    {
        $this->isAnswered = $isAnswered;

        return $this;
    }
}
