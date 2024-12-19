<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity]
class Etudiant extends User
{
  

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'integer')]
    private $age;

    #[ORM\ManyToOne(targetEntity:"Classe", inversedBy:"etudiants")]
    private $classe;



    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getClasse()
    {
        return $this->classe;
    }

    public function setClasse($classe): self
    {
        $this->classe = $classe;

        return $this;
    }
}
