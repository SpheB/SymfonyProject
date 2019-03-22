<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FanCommentRepository")
 */
class FanComment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text_comment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Look", inversedBy="fanComments")
     */
    private $id_look;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fan", inversedBy="fanComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_fan;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextComment(): ?string
    {
        return $this->text_comment;
    }

    public function setTextComment(string $text_comment): self
    {
        $this->text_comment = $text_comment;

        return $this;
    }

    public function getDateComment(): ?\DateTimeInterface
    {
        return $this->date_comment;
    }

    public function setDateComment(\DateTimeInterface $date_comment): self
    {
        $this->date_comment = $date_comment;

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

    public function getIdFan(): ?Fan
    {
        return $this->id_fan;
    }

    public function setIdFan(?Fan $id_fan): self
    {
        $this->id_fan = $id_fan;

        return $this;
    }
}
