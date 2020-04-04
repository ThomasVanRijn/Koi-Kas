<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity="App\Entity\BlogImage", mappedBy="blog")
     */
    private $images = [];

    public function __construct()
    {
        $this->serializer = new Serializer();
        $this->normalizer = new DataUriNormalizer();
        $this->blogImages = new ArrayCollection();
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

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
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

    /**
     * @return Collection|BlogImage[]
     */
    public function getBlogImages(): Collection
    {
        return $this->blogImages;
    }

    public function addBlogImage(BlogImage $blogImage): self
    {
        if (!$this->blogImages->contains($blogImage)) {
            $this->blogImages[] = $blogImage;
            $blogImage->setBlog($this);
        }

        return $this;
    }

    public function removeBlogImage(BlogImage $blogImage): self
    {
        if ($this->blogImages->contains($blogImage)) {
            $this->blogImages->removeElement($blogImage);
            // set the owning side to null (unless already changed)
            if ($blogImage->getBlog() === $this) {
                $blogImage->setBlog(null);
            }
        }

        return $this;
    }


}
