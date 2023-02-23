<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\MembreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    /**
     * @Assert\NotBlank(message="Le nom est obligatoire")
     */
    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;
    /**
     * @Assert\NotBlank(message="L'adresse email est obligatoire")
     * @Assert\Email(message="L'adresse email n'est pas valide")
     * @Assert\Length(max=255)
     */
    #[ORM\Column(length: 255)]
    private ?string $email = null;
    
    #[ORM\Column]
    private ?int $niveaucompte = null;
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;
     /**
     * @Assert\NotBlank(message="Le mot de passe est obligatoire")
     * @Assert\Length(min=6, max=255)
     */
    #[ORM\Column(length: 255)]
    private ?string $mdp_compte = null;

    #[ORM\Column(length: 255)]
    private ?string $token = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_token = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNiveaucompte(): ?int
    {
        return $this->niveaucompte;
    }

    public function setNiveaucompte(int $niveaucompte): self
    {
        $this->niveaucompte = $niveaucompte;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getMdpCompte(): ?string
    {
        return $this->mdp_compte;
    }

    public function setMdpCompte(string $mdp_compte): self
    {
        $this->mdp_compte = $mdp_compte;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getDateToken(): ?\DateTimeInterface
    {
        return $this->date_token;
    }

    public function setDateToken(\DateTimeInterface $date_token): self
    {
        $this->date_token = $date_token;

        return $this;
    }
}
