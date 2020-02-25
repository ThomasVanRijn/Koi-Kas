<?php

namespace App\Repository;

use App\Entity\Leeftijd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Leeftijd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Leeftijd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Leeftijd[]    findAll()
 * @method Leeftijd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeeftijdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Leeftijd::class);
    }

    // /**
    //  * @return Leeftijd[] Returns an array of Leeftijd objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Leeftijd
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
