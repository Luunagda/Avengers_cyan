<?php

namespace App\Entity;

use App\Repository\MarquePageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarquePageRepository::class)]
class MarquePage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mots_cles = null;

    #[ORM\ManyToMany(targetEntity: MotsCles::class, mappedBy: 'lien')]
    private Collection $motsCles;

    public function __construct()
    {
        $this->motsCles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getMotsCles(): ?string
    {
        return $this->mots_cles;
    }

    public function setMotsCles(?string $mots_cles): static
    {
        $this->mots_cles = $mots_cles;

        return $this;
    }

    public function addMotsCle(MotsCles $motsCle): static
    {
        if (!$this->motsCles->contains($motsCle)) {
            $this->motsCles->add($motsCle);
            $motsCle->addLien($this);
        }

        return $this;
    }

    public function removeMotsCle(MotsCles $motsCle): static
    {
        if ($this->motsCles->removeElement($motsCle)) {
            $motsCle->removeLien($this);
        }

        return $this;
    }
}
