<?php
namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NiveauRepository::class)]
class Niveau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type:"string")] 
    private $nom;

    // Utilisation de ArrayCollection pour gérer les relations OneToMany
    #[ORM\OneToMany(targetEntity: "Classe", mappedBy: "niveau")]
    private Collection $classes;

    #[ORM\OneToMany(targetEntity: "Cours", mappedBy: "niveau")]
    private Collection $cours;

    public function __construct()
    {
        // Initialisation des collections pour éviter les erreurs de type
        $this->classes = new ArrayCollection();
        $this->cours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function setClasses(Collection $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function setCours(Collection $cours): self
    {
        $this->cours = $cours;

        return $this;
    }
}
