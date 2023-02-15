<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_rec = null;

    #[ORM\Column(length: 255)]
    private ?string $type_rec = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_rec = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu_rec = null;

    #[ORM\Column]
    private ?int $statut_rec = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreRec(): ?string
    {
        return $this->titre_rec;
    }

    public function setTitreRec(string $titre_rec): self
    {
        $this->titre_rec = $titre_rec;

        return $this;
    }

    public function getTypeRec(): ?string
    {
        return $this->type_rec;
    }

    public function setTypeRec(string $type_rec): self
    {
        $this->type_rec = $type_rec;

        return $this;
    }

    public function getDateRec(): ?\DateTimeInterface
    {
        return $this->date_rec;
    }

    public function setDateRec(\DateTimeInterface $date_rec): self
    {
        $this->date_rec = $date_rec;

        return $this;
    }

    public function getContenuRec(): ?string
    {
        return $this->contenu_rec;
    }

    public function setContenuRec(string $contenu_rec): self
    {
        $this->contenu_rec = $contenu_rec;

        return $this;
    }

    public function getStatutRec(): ?int
    {
        return $this->statut_rec;
    }

    public function setStatutRec(int $statut_rec): self
    {
        $this->statut_rec = $statut_rec;

        return $this;
    }
    public function __toString()
    {
        return $this->getTitreRec()
        ;
    }
}
