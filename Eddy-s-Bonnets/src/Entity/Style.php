<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StyleRepository")
 */
class Style
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
    private $type_style;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Look", mappedBy="id_style")
     */
    private $looks;

    public function __construct()
    {
        $this->looks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeStyle(): ?string
    {
        return $this->type_style;
    }

    public function setTypeStyle(string $type_style): self
    {
        $this->type_style = $type_style;

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
            $look->setIdStyle($this);
        }

        return $this;
    }

    public function removeLook(Look $look): self
    {
        if ($this->looks->contains($look)) {
            $this->looks->removeElement($look);
            // set the owning side to null (unless already changed)
            if ($look->getIdStyle() === $this) {
                $look->setIdStyle(null);
            }
        }

        return $this;
    }
}
