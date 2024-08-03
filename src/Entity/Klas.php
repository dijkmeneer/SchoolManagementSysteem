<?php

namespace App\Entity;

use App\Repository\KlasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KlasRepository::class)]
class Klas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $naam = null;

    /**
     * @var Collection<int, Student>
     */
    #[ORM\OneToMany(targetEntity: Student::class, mappedBy: 'klas')]
    private Collection $students;

    /**
     * @var Collection<int, Leraar>
     */
    #[ORM\ManyToMany(targetEntity: Leraar::class, inversedBy: 'klas')]
    private Collection $leraar;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->leraar = new ArrayCollection();
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

    /**
     * @return Collection<int, Student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): static
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
            $student->setKlas($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): static
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getKlas() === $this) {
                $student->setKlas(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, leraar>
     */
    public function getLeraar(): Collection
    {
        return $this->leraar;
    }

    public function addLeraar(leraar $leraar): static
    {
        if (!$this->leraar->contains($leraar)) {
            $this->leraar->add($leraar);
        }

        return $this;
    }

    public function removeLeraar(leraar $leraar): static
    {
        $this->leraar->removeElement($leraar);

        return $this;
    }
}
