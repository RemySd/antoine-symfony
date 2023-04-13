<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_cours = null;



    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateHeureCour_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateHeureCour_fin = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false, name: 'id_matiere')]
    private ?Matiere $id_matiere = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false,name: 'id_calendrier', referencedColumnName:'id_calendrier')]
    private ?Calendrier $id_calendrier = null;


    public function __construct()
    {
        $this->id_intervenant = new ArrayCollection();
    }


    public function getIdCours(): ?int
    {
        return $this->id_cours;
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

    public function getIdMatiere(): ?Matiere
    {
        return $this->id_matiere;
    }

    public function setIdMatiere(?Matiere $id_matiere): self
    {
        $this->id_matiere = $id_matiere;

        return $this;
    }

    public function getIdCalendrier(): ?Calendrier
    {
        return $this->id_calendrier;
    }

    public function setIdCalendrier(?Calendrier $id_calendrier): self
    {
        $this->id_calendrier = $id_calendrier;

        return $this;
    }

    /**
     * @return Collection<int, Intervenant>
     */
    public function getIdIntervenant(): Collection
    {
        return $this->id_intervenant;
    }

    public function addIdIntervenant(Intervenant $idIntervenant): self
    {
        if (!$this->id_intervenant->contains($idIntervenant)) {
            $this->id_intervenant->add($idIntervenant);
        }

        return $this;
    }

    public function removeIdIntervenant(Intervenant $idIntervenant): self
    {
        $this->id_intervenant->removeElement($idIntervenant);

        return $this;
    }
}
