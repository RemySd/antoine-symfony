<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_matiere = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $libellé_matière = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $specialite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMatiere(): ?int
    {
        return $this->id_matiere;
    }

    public function setIdMatiere(int $id_matiere): self
    {
        $this->id_matiere = $id_matiere;

        return $this;
    }

    public function getLibelléMatière(): ?string
    {
        return $this->libellé_matière;
    }

    public function setLibelléMatière(?string $libellé_matière): self
    {
        $this->libellé_matière = $libellé_matière;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(?string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }
}
