<?php

namespace App\Repository;

use App\Entity\Lessen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lessen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lessen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lessen[]    findAll()
 * @method Lessen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LessenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lessen::class);
    }

    // /**
    //  * @return Lessen[] Returns an array of Lessen objects
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
    public function findOneBySomeField($value): ?Lessen
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
