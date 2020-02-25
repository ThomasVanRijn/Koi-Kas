<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeeftijdRepository")
 */
class Leeftijd
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
     * @ORM\OneToMany(targetEntity="App\Entity\Karper", mappedBy="leeftijd")
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
    public function getZoekNaam()
    {
        return $this->zoekNaam;
    }

    /**
     * @param mixed $zoekNaam
     */
    public function setZoekNaam($zoekNaam): void
    {
        $this->zoekNaam = $zoekNaam;
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
            $karper->setLeeftijd($this);
        }

        return $this;
    }

    public function removeKarper(Karper $karper): self
    {
        if ($this->karpers->contains($karper)) {
            $this->karpers->removeElement($karper);
            // set the owning side to null (unless already changed)
            if ($karper->getLeeftijd() === $this) {
                $karper->setLeeftijd(null);
            }
        }

        return $this;
    }
}
