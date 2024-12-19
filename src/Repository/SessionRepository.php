<?php
namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }


    public function findByNiveau($niveauId)
    {
        return $this->createQueryBuilder('c')
            ->where('c.niveau = :niveau')
            ->setParameter('niveau', $niveauId)
            ->getQuery()
            ->getResult();
    }


    public function findByClasse($classeId)
    {
        return $this->createQueryBuilder('c')
            ->join('c.classes', 'cl')
            ->where('cl.id = :classe')
            ->setParameter('classe', $classeId)
            ->getQuery()
            ->getResult();
    }
}
