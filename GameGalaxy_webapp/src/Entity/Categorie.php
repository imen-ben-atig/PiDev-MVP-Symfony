<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[assert\NotBlank(message:"Nom Obligatoire")]
    /**
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer un titre au mini de 5 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */

    private ?string $nom_categorie = null;

    #[ORM\Column]
    #[assert\NotBlank(message:"etat Obligatoire")]
    private ?int $etat = null;

    #[ORM\Column]
    #[assert\NotBlank(message:"type Obligatoire")]
    private ?int $type = null;

    #[ORM\OneToMany(mappedBy: 'id_categorie', targetEntity: Produit::class)]
    private Collection $id_categorie;

    public function __construct()
    {
        $this->id_categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nom_categorie;
    }

    public function setNomCategorie(string $nom_categorie): self
    {
        $this->nom_categorie = $nom_categorie;

        return $this;
    }

    public function isEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, produit>
     */
    public function getIdCategorie(): Collection
    {
        return $this->id_categorie;
    }

    public function addIdCategorie(produit $idCategorie): self
    {
        if (!$this->id_categorie->contains($idCategorie)) {
            $this->id_categorie->add($idCategorie);
            $idCategorie->setIdCategorie($this);
        }

        return $this;
    }

    public function removeIdCategorie(produit $idCategorie): self
    {
        if ($this->id_categorie->removeElement($idCategorie)) {
            // set the owning side to null (unless already changed)
            if ($idCategorie->getIdCategorie() === $this) {
                $idCategorie->setIdCategorie(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNomCategorie();
    }
}
