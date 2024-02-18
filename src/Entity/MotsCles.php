<?php

namespace App\Entity;

use App\Repository\MotsClesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotsClesRepository::class)]
class MotsCles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $motsCles = null;

    #[ORM\ManyToMany(targetEntity: MarquePage::class, inversedBy: 'motsCles')]
    private Collection $lien;

    public function __construct()
    {
        $this->lien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotsCles(): ?string
    {
        return $this->motsCles;
    }

    public function setMotsCles(string $motsCles): static
    {
        $this->motsCles = $motsCles;

        return $this;
    }

    /**
     * @return Collection<int, MarquePage>
     */
    public function getLien(): Collection
    {
        return $this->lien;
    }

    public function addLien(MarquePage $lien): static
    {
        if (!$this->lien->contains($lien)) {
            $this->lien->add($lien);
        }

        return $this;
    }

    public function removeLien(MarquePage $lien): static
    {
        $this->lien->removeElement($lien);

        return $this;
    }
}
