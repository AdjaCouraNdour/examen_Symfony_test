<?php

namespace App\Entity;
use App\Repository\ProfesseurRepository;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur extends User
{

    #[ORM\OneToMany(targetEntity:"Cours", mappedBy:"professeur")]
    private $cours;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;
    
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

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
    public function getCours()
    {
        return $this->cours;
    }

    public function setCours($cours): self
    {
        $this->cours = $cours;

        return $this;
    }
}
