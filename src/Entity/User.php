<?php

namespace App\Entity;
use App\Repository\UserRepository;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: "user")]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "user_type", type: "string")]
#[ORM\DiscriminatorMap(["user" => "User", "professeur" => "Professeur","administrateur" => "Administrateur","etudiant" => "Etudiant"])]
abstract class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(
        message: 'veillez entrer un login valide',
        groups: ['WITH_USER']
    )]
    private ?string $login = null;

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: 'veillez entrer un password valide',
        groups: ['WITH_USER']
    )]
    private ?string $password = null;

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
