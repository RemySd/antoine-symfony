<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_role = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $Statut = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(?string $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }
}
