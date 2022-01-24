<?php

namespace App\Repository;

use App\Entity\TV;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TV|null find($id, $lockMode = null, $lockVersion = null)
 * @method TV|null findOneBy(array $criteria, array $orderBy = null)
 * @method TV[]    findAll()
 * @method TV[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TVRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TV::class);
    }

    // /**
    //  * @return TV[] Returns an array of TV objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TV
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
