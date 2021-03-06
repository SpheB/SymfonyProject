<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LookRepository")
 */
class Look
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Style", inversedBy="looks")
     */
    private $id_style;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Concours", mappedBy="gagnant")
     */
    private $concourss;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FanComment", mappedBy="id_look")
     */
    private $fanComments;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_look;

    /**
     * @ORM\Column(type="text")
     */
    private $descr_long;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="id_look")
     */
    private $votes;

    public function __construct()
    {
        $this->concourss = new ArrayCollection();
        $this->fanComments = new ArrayCollection();
        $this->votes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    public function getIdStyle(): ?Style
    {
        return $this->id_style;
    }

    public function setIdStyle(?Style $id_style): self
    {
        $this->id_style = $id_style;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(?int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * @return Collection|Concours[]
     */
    public function getConcourss(): Collection
    {
        return $this->concourss;
    }

    public function addConcours(Concours $concours): self
    {
        if (!$this->concourss->contains($concours)) {
            $this->concourss[] = $concours;
            $concours->setGagnant($this);
        }

        return $this;
    }

    public function removeConcours(Concours $concours): self
    {
        if ($this->concourss->contains($concours)) {
            $this->concourss->removeElement($concours);
            // set the owning side to null (unless already changed)
            if ($concours->getGagnant() === $this) {
                $concours->setGagnant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FanComment[]
     */
    public function getFanComments(): Collection
    {
        return $this->fanComments;
    }

    public function addFanComment(FanComment $fanComment): self
    {
        if (!$this->fanComments->contains($fanComment)) {
            $this->fanComments[] = $fanComment;
            $fanComment->setIdLook($this);
        }

        return $this;
    }

    public function removeFanComment(FanComment $fanComment): self
    {
        if ($this->fanComments->contains($fanComment)) {
            $this->fanComments->removeElement($fanComment);
            // set the owning side to null (unless already changed)
            if ($fanComment->getIdLook() === $this) {
                $fanComment->setIdLook(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateLook(): ?\DateTimeInterface
    {
        return $this->date_look;
    }

    public function setDateLook(?\DateTimeInterface $date_look): self
    {
        $this->date_look = $date_look;

        return $this;
    }

    public function getDescrLong(): ?string
    {
        return $this->descr_long;
    }

    public function setDescrLong(string $descr_long): self
    {
        $this->descr_long = $descr_long;

        return $this;
    }

    /**
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setIdLook($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->contains($vote)) {
            $this->votes->removeElement($vote);
            // set the owning side to null (unless already changed)
            if ($vote->getIdLook() === $this) {
                $vote->setIdLook(null);
            }
        }

        return $this;
    }
}
