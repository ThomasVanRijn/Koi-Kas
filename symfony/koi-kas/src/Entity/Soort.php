<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\DocBlock\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SoortRepository")
 */
class Soort
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
     * @ORM\OneToMany(targetEntity="App\Entity\Karper", mappedBy="soort")
     */
    private $karpers;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zoekNaam;



    public function __construct()
    {
        $this->karpers = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * @param mixed $naam
     */
    public function setNaam($naam): void
    {
        $this->naam = $naam;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Karper[]
     */
    public function getKarpers(): Collection
    {
        return $this->karpers;
    }

    public function addKarper(Karper $karper): self
    {
        if (!$this->karpers->contains($karper)) {
            $this->karpers[] = $karper;
            $karper->setSoort($this);
        }

        return $this;
    }

    public function removeKarper(Karper $karper): self
    {
        if ($this->karpers->contains($karper)) {
            $this->karpers->removeElement($karper);
            // set the owning side to null (unless already changed)
            if ($karper->getSoort() === $this) {
                $karper->setSoort(null);
            }
        }

        return $this;
    }

    public function getZoekNaam(): ?string
    {
        return $this->zoekNaam;
    }

    public function setZoekNaam(string $zoekNaam): self
    {
        $this->zoekNaam = $zoekNaam;

        return $this;
    }





}
