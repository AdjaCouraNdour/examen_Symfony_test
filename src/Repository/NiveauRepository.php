<?php
namespace App\Repository;

use App\Entity\Niveau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class NiveauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Niveau::class);
    }

    public function findAllNiveaux()
    {
        return $this->createQueryBuilder('n')
            ->getQuery()
            ->getResult();
    }

    public function findNiveauById($niveauId)
    {
        return $this->createQueryBuilder('n')
            ->where('n.id = :id')
            ->setParameter('id', $niveauId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
