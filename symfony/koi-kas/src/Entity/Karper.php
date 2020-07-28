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
     * @ORM\ManyToOne(targetEntity="App\Entity\Soort", inversedBy="karpers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $soort;

    /**
     * @ORM\Column(type="float")
     */
    private $maat;

    /**
     * @ORM\Column(type="float")
     */
    private $prijs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Kweker", inversedBy="karpers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $kweker;

    /**
     * @ORM\Column(type="integer")
     */
    private $leeftijd;

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

    public function getSoort(): ?Soort
    {
        return $this->soort;
    }

    public function setSoort(?Soort $soort): self
    {
        $this->soort = $soort;

        return $this;
    }

    public function getMaat(): ?float
    {
        return $this->maat;
    }

    public function setMaat(float $maat): self
    {
        $this->maat = $maat;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(float $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getKweker(): ?Kweker
    {
        return $this->kweker;
    }

    public function setKweker(?Kweker $kweker): self
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
}
