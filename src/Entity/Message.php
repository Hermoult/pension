<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
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
    private $subject;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $receiver;

    /**
     * @ORM\Column(type="date")
     */
    private $dateSending;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $askAppoitment;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateAppoitment;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $askEstheticTreatment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $askHealth;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $askGeoloc;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_iduser;

    /**
     * @ORM\ManyToOne(targetEntity=Animal::class, inversedBy="messages")
     */
    private $animal_idanimal;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSender(): ?string
    {
        return $this->sender;
    }

    public function setSender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getReceiver(): ?string
    {
        return $this->receiver;
    }

    public function setReceiver(string $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function getDateSending(): ?\DateTimeInterface
    {
        return $this->dateSending;
    }

    public function setDateSending(\DateTimeInterface $dateSending): self
    {
        $this->dateSending = $dateSending;

        return $this;
    }

    public function getAskAppoitment(): ?bool
    {
        return $this->askAppoitment;
    }

    public function setAskAppoitment(?bool $askAppoitment): self
    {
        $this->askAppoitment = $askAppoitment;

        return $this;
    }

    public function getDateAppoitment(): ?\DateTimeInterface
    {
        return $this->dateAppoitment;
    }

    public function setDateAppoitment(?\DateTimeInterface $dateAppoitment): self
    {
        $this->dateAppoitment = $dateAppoitment;

        return $this;
    }

    public function getAskEstheticTreatment(): ?bool
    {
        return $this->askEstheticTreatment;
    }

    public function setAskEstheticTreatment(?bool $askEstheticTreatment): self
    {
        $this->askEstheticTreatment = $askEstheticTreatment;

        return $this;
    }

    public function getAskHealth(): ?bool
    {
        return $this->askHealth;
    }

    public function setAskHealth(bool $askHealth): self
    {
        $this->askHealth = $askHealth;

        return $this;
    }

    public function getAskGeoloc(): ?bool
    {
        return $this->askGeoloc;
    }

    public function setAskGeoloc(?bool $askGeoloc): self
    {
        $this->askGeoloc = $askGeoloc;

        return $this;
    }

    public function getUserIduser(): ?User
    {
        return $this->user_iduser;
    }

    public function setUserIduser(?User $user_iduser): self
    {
        $this->user_iduser = $user_iduser;

        return $this;
    }

    public function getAnimalIdanimal(): ?Animal
    {
        return $this->animal_idanimal;
    }

    public function setAnimalIdanimal(?Animal $animal_idanimal): self
    {
        $this->animal_idanimal = $animal_idanimal;

        return $this;
    }

}
