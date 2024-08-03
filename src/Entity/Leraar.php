<?php

namespace App\Entity;

use App\Repository\LeraarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeraarRepository::class)]
class Leraar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $naam = null;

    #[ORM\Column]
    private ?int $leeftijd = null;

    /**
     * @var Collection<int, Klas>
     */
    #[ORM\ManyToMany(targetEntity: Klas::class, mappedBy: 'leraar')]
    private Collection $klas;

    public function __construct()
    {
        $this->klas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): static
    {
        $this->naam = $naam;

        return $this;
    }

    public function getLeeftijd(): ?int
    {
        return $this->leeftijd;
    }

    public function setLeeftijd(int $leeftijd): static
    {
        $this->leeftijd = $leeftijd;

        return $this;
    }

    /**
     * @return Collection<int, Klas>
     */
    public function getKlas(): Collection
    {
        return $this->klas;
    }

    public function addKla(Klas $kla): static
    {
        if (!$this->klas->contains($kla)) {
            $this->klas->add($kla);
            $kla->addLeraar($this);
        }

        return $this;
    }

    public function removeKla(Klas $kla): static
    {
        if ($this->klas->removeElement($kla)) {
            $kla->removeLeraar($this);
        }

        return $this;
    }
}
