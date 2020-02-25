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
     * @ORM\ManyToOne(targetEntity="App\Entity\Kweker", inversedBy="karpers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $kweker;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Leeftijd", inversedBy="karpers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $leeftijd;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Maat", inversedBy="karpers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $maat;

    /**
     * @ORM\Column(type="string", length=100000000000000)
     */
    private $image;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prijs;

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

    public function getKweker(): ?kweker
    {
        return $this->kweker;
    }

    public function setKweker(?kweker $kweker): self
    {
        $this->kweker = $kweker;

        return $this;
    }

    public function getLeeftijd(): ?leeftijd
    {
        return $this->leeftijd;
    }

    public function setLeeftijd(?leeftijd $leeftijd): self
    {
        $this->leeftijd = $leeftijd;

        return $this;
    }

    public function getMaat(): ?maat
    {
        return $this->maat;
    }

    public function setMaat(?maat $maat): self
    {
        $this->maat = $maat;

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

    public function getPrijs(): ?string
    {
        return $this->prijs;
    }

    public function setPrijs(string $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }
}
