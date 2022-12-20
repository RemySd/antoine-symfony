<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_cours = null;

    #[ORM\Column]
    private ?int $id_calendrier = null;

    #[ORM\Column]
    private ?int $id_matiere = null;

    #[ORM\Column]
    private ?int $id_intervenant = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateHeureCour_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateHeureCour_fin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCours(): ?int
    {
        return $this->id_cours;
    }

    public function setIdCours(int $id_cours): self
    {
        $this->id_cours = $id_cours;

        return $this;
    }

    public function getIdCalendrier(): ?int
    {
        return $this->id_calendrier;
    }

    public function setIdCalendrier(int $id_calendrier): self
    {
        $this->id_calendrier = $id_calendrier;

        return $this;
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

    public function getIdIntervenant(): ?int
    {
        return $this->id_intervenant;
    }

    public function setIdIntervenant(int $id_intervenant): self
    {
        $this->id_intervenant = $id_intervenant;

        return $this;
    }

    public function getDateHeureCourDebut(): ?\DateTimeInterface
    {
        return $this->dateHeureCour_debut;
    }

    public function setDateHeureCourDebut(?\DateTimeInterface $dateHeureCour_debut): self
    {
        $this->dateHeureCour_debut = $dateHeureCour_debut;

        return $this;
    }

    public function getDateHeureCourFin(): ?\DateTimeInterface
    {
        return $this->dateHeureCour_fin;
    }

    public function setDateHeureCourFin(?\DateTimeInterface $dateHeureCour_fin): self
    {
        $this->dateHeureCour_fin = $dateHeureCour_fin;

        return $this;
    }
}
