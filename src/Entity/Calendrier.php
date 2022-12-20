<?php

namespace App\Entity;

use App\Repository\CalendrierRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendrierRepository::class)]
class Calendrier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_calendrier = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $libellé_periode = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_fin = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLibelléPeriode(): ?string
    {
        return $this->libellé_periode;
    }

    public function setLibelléPeriode(?string $libellé_periode): self
    {
        $this->libellé_periode = $libellé_periode;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(?\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }
}
