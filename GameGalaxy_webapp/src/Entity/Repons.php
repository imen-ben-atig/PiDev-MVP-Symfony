<?php

namespace App\Entity;

use App\Repository\ReponsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponsRepository::class)]
class Repons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_rep = null;

    #[ORM\Column]
    private ?int $status_rep = null;

    #[ORM\Column(length: 255)]
    private ?string $relation = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reclamation $id_reclamation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRep(): ?\DateTimeInterface
    {
        return $this->date_rep;
    }

    public function setDateRep(\DateTimeInterface $date_rep): self
    {
        $this->date_rep = $date_rep;

        return $this;
    }

    public function getStatusRep(): ?int
    {
        return $this->status_rep;
    }

    public function setStatusRep(int $status_rep): self
    {
        $this->status_rep = $status_rep;

        return $this;
    }
    public function getIdReclamation(): ?Reclamation
    {
        return $this->id_reclamation;
    }

    public function setIdReclamation(Reclamation $id_reclamation): self
    {
        $this->id_reclamation = $id_reclamation;

        return $this;
    }
}
