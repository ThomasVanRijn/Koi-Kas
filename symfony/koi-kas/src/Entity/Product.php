<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prijs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $beschrijving;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=100000000000)
     */
    private $image;

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

    public function getPrijs(): ?string
    {
        return $this->prijs;
    }

    public function setPrijs(string $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getBeschrijving(): ?string
    {
        return $this->beschrijving;
    }

    public function setBeschrijving(?string $beschrijving): self
    {
        $this->beschrijving = $beschrijving;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
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

    public function getUri(): ?string
    {
        return $this->uri;
    }

}
