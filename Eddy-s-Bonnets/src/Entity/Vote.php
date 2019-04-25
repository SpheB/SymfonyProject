<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_vote;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Concours", inversedBy="votes")
     */
    private $id_concours;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fan", inversedBy="votes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_fan;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Look", inversedBy="votes")
     */
    private $id_look;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateVote(): ?\DateTimeInterface
    {
        return $this->date_vote;
    }

    public function setDateVote(\DateTimeInterface $date_vote): self
    {
        $this->date_vote = $date_vote;

        return $this;
    }

    public function getIdConcours(): ?Concours
    {
        return $this->id_concours;
    }

    public function setIdConcours(?Concours $id_concours): self
    {
        $this->id_concours = $id_concours;

        return $this;
    }

    public function getIdFan(): ?fan
    {
        return $this->id_fan;
    }

    public function setIdFan(?fan $id_fan): self
    {
        $this->id_fan = $id_fan;

        return $this;
    }

    public function getIdLook(): ?Look
    {
        return $this->id_look;
    }

    public function setIdLook(?Look $id_look): self
    {
        $this->id_look = $id_look;

        return $this;
    }
}
