<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogImageRepository")
 */
class BlogImage
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
    private $file_naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file_path;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $extension;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BlogPost", inversedBy="blogImages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $blog;

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

    public function getFileNaam(): ?string
    {
        return $this->file_naam;
    }

    public function setFileNaam(string $file_naam): self
    {
        $this->file_naam = $file_naam;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->file_path;
    }

    public function setFilePath(string $file_path): self
    {
        $this->file_path = $file_path;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getBlog(): ?BlogPost
    {
        return $this->blog;
    }

    public function setBlog(?BlogPost $blog): self
    {
        $this->blog = $blog;

        return $this;
    }
}
