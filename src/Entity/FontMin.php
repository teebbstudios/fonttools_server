<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FontMinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FontMinRepository::class)]
#[ApiResource(

)]
class FontMin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $fontFamily;

    #[ORM\Column(type: 'text')]
    private $text;

    #[ORM\Column(type: 'string', length: 100)]
    private $textHash;

    #[ORM\Column(type: 'string', length: 255)]
    private $newFontFamily;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFontFamily(): ?string
    {
        return $this->fontFamily;
    }

    public function setFontFamily(string $fontFamily): self
    {
        $this->fontFamily = $fontFamily;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getTextHash(): ?string
    {
        return $this->textHash;
    }

    public function setTextHash(string $textHash): self
    {
        $this->textHash = $textHash;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNewFontFamily(): ?string
    {
        return $this->newFontFamily;
    }

    public function setNewFontFamily(string $newFontFamily): self
    {
        $this->newFontFamily = $newFontFamily;

        return $this;
    }
}
