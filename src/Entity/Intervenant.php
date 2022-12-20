<?php

namespace App\Entity;

use App\Repository\IntervenantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IntervenantRepository::class)]
class Intervenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_intervenant = null;

    #[ORM\Column]
    private ?int $id_utilisateur = null;

    #[ORM\Column]
    private ?int $id_role = null;

    #[ORM\Column]
    private ?int $id_matiere = null;

    #[ORM\Column(nullable: true)]
    private ?int $nb_heure = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdUtilisateur(): ?int
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(int $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    public function getIdRole(): ?int
    {
        return $this->id_role;
    }

    public function setIdRole(int $id_role): self
    {
        $this->id_role = $id_role;

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

    public function getNbHeure(): ?int
    {
        return $this->nb_heure;
    }

    public function setNbHeure(?int $nb_heure): self
    {
        $this->nb_heure = $nb_heure;

        return $this;
    }
}
