<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KwekerRepository")
 */
class Kweker
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
     * @ORM\OneToMany(targetEntity="App\Entity\Karper", mappedBy="kweker")
     */
    private $karpers;

    public function __construct()
    {
        $this->karpers = new ArrayCollection();
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
            $karper->setKweker($this);
        }

        return $this;
    }

    public function removeKarper(Karper $karper): self
    {
        if ($this->karpers->contains($karper)) {
            $this->karpers->removeElement($karper);
            // set the owning side to null (unless already changed)
            if ($karper->getKweker() === $this) {
                $karper->setKweker(null);
            }
        }

        return $this;
    }
}
