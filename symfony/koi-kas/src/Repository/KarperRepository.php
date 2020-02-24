<?php

namespace App\Repository;

use App\Entity\Karper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Karper|null find($id, $lockMode = null, $lockVersion = null)
 * @method Karper|null findOneBy(array $criteria, array $orderBy = null)
 * @method Karper[]    findAll()
 * @method Karper[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KarperRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Karper::class);
    }

    // /**
    //  * @return Karper[] Returns an array of Karper objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Karper
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
