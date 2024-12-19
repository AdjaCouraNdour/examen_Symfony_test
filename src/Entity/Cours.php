<?php
namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
#[ORM\Table(name: "cours")] 
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Professeur", inversedBy: "cours")]
    #[ORM\JoinColumn(nullable: false)]
    private Professeur $professeur;

    #[ORM\ManyToMany(targetEntity: "App\Entity\Classe", mappedBy: "cours")]
    private Collection $classes;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Module", inversedBy: "cours")]
    private ?Module $module;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Niveau", inversedBy: "cours")]
    #[ORM\JoinColumn(nullable: false)]
    private Niveau $niveau;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfesseur(): Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(Professeur $professeur): self
    {
        $this->professeur = $professeur;
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

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): self
    {
        $this->module = $module;
        return $this;
    }

    public function getNiveau(): Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(Niveau $niveau): self
    {
        $this->niveau = $niveau;
        return $this;
    }

    public function addClasse(Classe $classe): self
    {
        if (!$this->classes->contains($classe)) {
            $this->classes[] = $classe;
        }

        return $this;
    }

    public function removeClasse(Classe $classe): self
    {
        $this->classes->removeElement($classe);

        return $this;
    }
}
