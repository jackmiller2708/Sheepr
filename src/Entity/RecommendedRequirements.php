<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecommendedRequirementsRepository")
 */
class RecommendedRequirements
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Post", inversedBy="recommendedRequirements", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Post;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $OS;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Processor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Memory;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Graphics;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DiskSpace;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?Post
    {
        return $this->Post;
    }

    public function setPost(Post $Post): self
    {
        $this->Post = $Post;

        return $this;
    }

    public function getOS(): ?string
    {
        return $this->OS;
    }

    public function setOS(string $OS): self
    {
        $this->OS = $OS;

        return $this;
    }

    public function getProcessor(): ?string
    {
        return $this->Processor;
    }

    public function setProcessor(string $Processor): self
    {
        $this->Processor = $Processor;

        return $this;
    }

    public function getMemory(): ?string
    {
        return $this->Memory;
    }

    public function setMemory(string $Memory): self
    {
        $this->Memory = $Memory;

        return $this;
    }

    public function getGraphics(): ?string
    {
        return $this->Graphics;
    }

    public function setGraphics(string $Graphics): self
    {
        $this->Graphics = $Graphics;

        return $this;
    }

    public function getDiskSpace(): ?string
    {
        return $this->DiskSpace;
    }

    public function setDiskSpace(string $DiskSpace): self
    {
        $this->DiskSpace = $DiskSpace;

        return $this;
    }
}
