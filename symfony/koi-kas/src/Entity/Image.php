<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
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
     * @ORM\Column(type="string", length=10000000000)
     */
    private $string;

    /**
     * @ORM\Column(type="string", length=1000000000)
     */
    private $uri;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hoogte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $breedte;

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

    public function getUri(): ?string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): self
    {
        $normalizer = new DataUriNormalizer();
        $uri = $normalizer->normalize(new \SplFileObject($uri));
        $this->uri = $uri;

        return $this;
    }

    public function getHoogte(): ?string
    {
        return $this->hoogte;
    }

    public function setHoogte(string $hoogte): self
    {
        $this->hoogte = $hoogte;

        return $this;
    }

    public function getBreedte(): ?string
    {
        return $this->breedte;
    }

    public function setBreedte(string $breedte): self
    {
        $this->breedte = $breedte;

        return $this;
    }

    public function setString(string $breedte, string $hoogte, string $uri) {
        $string = "<img style='height:" . $hoogte . "; width:" . $breedte . "' src='" . $uri . "'>";

        $this->string = $string;

        return $this;
    }

    public function getString(): ?string{

        return $this->string;

    }
}
