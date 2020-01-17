<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinksRepository")
 */
class Links
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Post", inversedBy="links", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Post;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Fshare;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $GoogleDrive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Steam;

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

    public function getFshare(): ?string
    {
        return $this->Fshare;
    }

    public function setFshare(?string $Fshare): self
    {
        $this->Fshare = $Fshare;

        return $this;
    }

    public function getGoogleDrive(): ?string
    {
        return $this->GoogleDrive;
    }

    public function setGoogleDrive(?string $GoogleDrive): self
    {
        $this->GoogleDrive = $GoogleDrive;

        return $this;
    }

    public function getSteam(): ?string
    {
        return $this->Steam;
    }

    public function setSteam(?string $Steam): self
    {
        $this->Steam = $Steam;

        return $this;
    }
}
