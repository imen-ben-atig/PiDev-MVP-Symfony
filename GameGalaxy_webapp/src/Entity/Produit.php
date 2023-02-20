<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
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

    private ?string $nom_produit = null;
   

    #[ORM\Column]
    #[assert\NotBlank(message:"Prix Obligatoire")]
     /**
 * @ORM\Column(type="integer")
 * @Assert\Regex(
 *     pattern="/^[0-9]+$/",
 *     message="Entrer des valeurs numériques uniquement."
 * )
 */

    private ?float $prix = null;

    #[ORM\Column(type: Types::TEXT)]
    #[assert\NotBlank(message:"Description Obligatoire")]
    /**
     * @Assert\Length(
     *      min = 20,
     *      minMessage=" Entrer un titre au mini de 20 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */

    
    private ?string $description = null;
    
    

    #[ORM\Column]
    #[assert\NotBlank(message:"Stock Obligatoire")]
    /**

    
 * @Assert\Regex(
 *      pattern="/^[0-9]+$/",
 *      message="Entrez seulement des chiffres"
 * )
 * @ORM\Column(type="string", length=255)
 */


    private ?int $stock = null;
    

    #[ORM\Column(length: 255)]
    #[assert\NotBlank(message:"Image Obligatoire")]
    private ?string $img = null;

    #[ORM\ManyToOne(inversedBy: 'id_categorie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $id_categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nom_produit;
    }

    public function setNomProduit(string $nom_produit): self
    {
        $this->nom_produit = $nom_produit;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getIdCategorie(): ?Categorie
    {
        return $this->id_categorie;
    }

    public function setIdCategorie(?Categorie $id_categorie): self
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }
}
