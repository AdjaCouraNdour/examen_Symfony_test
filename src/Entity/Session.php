<?php

namespace App\Entity;
use App\Repository\SessionRepository;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity:"Cours", inversedBy:"sessions")]
    #[ORM\JoinColumn(nullable:false)]
    private $cours;

    #[ORM\Column(type:"datetime")]
    private $dateDebut;

    #[ORM\Column(type:"datetime")]
    private $dateFin;

    #[ORM\Column(type:"string", nullable:true)]
    private $salle;

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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getSalle(): ?string
    {
        return $this->salle;
    }

    public function setSalle(?string $salle): self
    {
        $this->salle = $salle;

        return $this;
    }
}
