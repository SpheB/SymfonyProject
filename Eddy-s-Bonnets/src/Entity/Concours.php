<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConcoursRepository")
 */
class Concours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $theme;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_fin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Look", inversedBy="concours")
     */
    private $gagnant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Look", inversedBy="concours")
     */
    private $looks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="id_concours")
     */
    private $votes;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $comment_concours;

    public function __construct()
    {
        $this->looks = new ArrayCollection();
        $this->votes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getGagnant(): ?Look
    {
        return $this->gagnant;
    }

    public function setGagnant(?Look $gagnant): self
    {
        $this->gagnant = $gagnant;

        return $this;
    }

    /**
     * @return Collection|Look[]
     */
    public function getLooks(): Collection
    {
        return $this->looks;
    }

    public function addLook(Look $look): self
    {
        if (!$this->looks->contains($look)) {
            $this->looks[] = $look;
        }

        return $this;
    }

    public function removeLook(Look $look): self
    {
        if ($this->looks->contains($look)) {
            $this->looks->removeElement($look);
        }

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
            $vote->setIdConcours($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->contains($vote)) {
            $this->votes->removeElement($vote);
            // set the owning side to null (unless already changed)
            if ($vote->getIdConcours() === $this) {
                $vote->setIdConcours(null);
            }
        }

        return $this;
    }

    public function getCommentConcours(): ?string
    {
        return $this->comment_concours;
    }

    public function setCommentConcours(?string $comment_concours): self
    {
        $this->comment_concours = $comment_concours;

        return $this;
    }
}
