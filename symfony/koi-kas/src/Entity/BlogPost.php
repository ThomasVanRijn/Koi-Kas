<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostRepository")
 */
class BlogPost
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
     * @ORM\Column(type="string", length=1000000000000)
     */
    private $verhaal;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $images = [];

    public function __construct()
    {
        $this->serializer = new Serializer();
        $this->normalizer = new DataUriNormalizer();
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

    public function getVerhaal(): ?string
    {
        return $this->verhaal;
    }

    public function setVerhaal(string $verhaal): self
    {
        $this->verhaal = $verhaal;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $normalizer = new DataUriNormalizer();
        $images = $normalizer->normalize($images);
        $this->images = $images;

        return $this;
    }


}
