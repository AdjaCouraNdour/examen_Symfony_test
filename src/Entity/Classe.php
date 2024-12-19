<?php
namespace App\Entity;
use App\Repository\ClasseRepository;

use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity:"Cours", inversedBy:"classes")]
    private $cours;

    #[ORM\OneToMany(targetEntity:"Etudiant", mappedBy:"classe")]
    private $etudiants;

    #[ORM\ManyToOne(targetEntity:"Niveau", inversedBy:"classes")]
    private $niveau;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;
    

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCours()
    {
        return $this->cours;
    }

    public function setCours($cours): self
    {
        $this->cours = $cours;

        return $this;
    }

    public function getEtudiants()
    {
        return $this->etudiants;
    }

    public function setEtudiants($etudiants): self
    {
        $this->etudiants = $etudiants;

        return $this;
    }

    public function getNiveau()
    {
        return $this->niveau;
    }

    public function setNiveau($niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }
}
