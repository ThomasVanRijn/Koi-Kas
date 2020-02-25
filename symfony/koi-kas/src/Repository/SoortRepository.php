<?php

namespace App\Repository;

use App\Entity\Soort;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Soort|null find($id, $lockMode = null, $lockVersion = null)
 * @method Soort|null findOneBy(array $criteria, array $orderBy = null)
 * @method Soort[]    findAll()
 * @method Soort[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoortRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Soort::class);
    }

    // /**
    //  * @return Soort[] Returns an array of Soort objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Soort
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
