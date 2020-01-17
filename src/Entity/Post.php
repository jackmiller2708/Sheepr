<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\MinimumRequirements", mappedBy="Post", cascade={"persist", "remove"})
     */
    private $minimumRequirements;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\RecommendedRequirements", mappedBy="Post", cascade={"persist", "remove"})
     */
    private $recommendedRequirements;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Links", mappedBy="Post", cascade={"persist", "remove"})
     */
    private $links;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Genre", inversedBy="posts")
     */
    private $Genre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;


    /**
     * @ORM\Column(type="datetime")
     */
    private $TimePosted;

    /**
     * @ORM\Column(type="integer")
     */
    private $views;

    /**
     * @ORM\Column(type="integer")
     */
    private $downloads;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $posterFileName;

    public function __construct()
    {
        $this->Genre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getMinimumRequirements(): ?MinimumRequirements
    {
        return $this->minimumRequirements;
    }

    public function setMinimumRequirements(MinimumRequirements $minimumRequirements): self
    {
        $this->minimumRequirements = $minimumRequirements;

        // set the owning side of the relation if necessary
        if ($minimumRequirements->getPost() !== $this) {
            $minimumRequirements->setPost($this);
        }

        return $this;
    }

    public function getRecommendedRequirements(): ?RecommendedRequirements
    {
        return $this->recommendedRequirements;
    }

    public function setRecommendedRequirements(RecommendedRequirements $recommendedRequirements): self
    {
        $this->recommendedRequirements = $recommendedRequirements;

        // set the owning side of the relation if necessary
        if ($recommendedRequirements->getPost() !== $this) {
            $recommendedRequirements->setPost($this);
        }

        return $this;
    }

    public function getLinks(): ?Links
    {
        return $this->links;
    }

    public function setLinks(Links $links): self
    {
        $this->links = $links;

        // set the owning side of the relation if necessary
        if ($links->getPost() !== $this) {
            $links->setPost($this);
        }

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenre(): Collection
    {
        return $this->Genre;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->Genre->contains($genre)) {
            $this->Genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->Genre->contains($genre)) {
            $this->Genre->removeElement($genre);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTimePosted(): ?DateTimeInterface
    {
        return $this->TimePosted;
    }

    public function setTimePosted(): self
    {
        $this->TimePosted = new DateTime('now');

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(int $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function getDownloads(): ?int
    {
        return $this->downloads;
    }

    public function setDownloads(string $downloads): self
    {
        $this->downloads = $downloads;

        return $this;
    }

    public function getPosterFileName(): ?string
    {
        return $this->posterFileName;
    }

    public function setPosterFileName(string $posterFileName): self
    {
        $this->posterFileName = $posterFileName;

        return $this;
    }
}
