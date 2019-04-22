<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 */
class News
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $text_news;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_news;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture_news;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $accroche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTextNews(): ?string
    {
        return $this->text_news;
    }

    public function setTextNews(string $news_text): self
    {
        $this->text_news = $news_text;

        return $this;
    }

    public function getDateNews(): ?\DateTimeInterface
    {
        return $this->date_news;
    }

    public function setDateNews(?\DateTimeInterface $news_date): self
    {
        $this->date_news = $news_date;

        return $this;
    }

    public function getPictureNews()
    {
        return $this->picture_news;
    }

    public function setPictureNews($picture_news)
    {
        $this->picture_news = $picture_news;

        return $this;
    }

    public function getAccroche(): ?string
    {
        return $this->accroche;
    }

    public function setAccroche(?string $accroche): self
    {
        $this->accroche = $accroche;

        return $this;
    }
}
