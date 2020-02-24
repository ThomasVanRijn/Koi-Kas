<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KarperRepository")
 */
class Karper
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
     * @ORM\Column(type="string", length=255)
     */
    private $soort;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kweker;

    /**
     * @ORM\Column(type="integer")
     */
    private $leeftijd;

    /**
     * @ORM\Column(type="integer")
     */
    private $maat;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prijs;

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

    public function getSoort(): ?string
    {
        return $this->soort;
    }

    public function setSoort(string $soort): self
    {
        $this->soort = $soort;

        return $this;
    }

    public function getKweker(): ?string
    {
        return $this->kweker;
    }

    public function setKweker(string $kweker): self
    {
        $this->kweker = $kweker;

        return $this;
    }

    public function getLeeftijd(): ?int
    {
        return $this->leeftijd;
    }

    public function setLeeftijd(int $leeftijd): self
    {
        $this->leeftijd = $leeftijd;

        return $this;
    }

    public function getMaat(): ?int
    {
        return $this->maat;
    }

    public function setMaat(int $maat): self
    {
        $this->maat = $maat;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
