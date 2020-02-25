<?php

namespace App\Repository;

use App\Entity\Kweker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Kweker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kweker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kweker[]    findAll()
 * @method Kweker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KwekerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kweker::class);
    }

    // /**
    //  * @return Kweker[] Returns an array of Kweker objects
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
    public function findOneBySomeField($value): ?Kweker
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
