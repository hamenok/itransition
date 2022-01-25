<?php

namespace App\Repository;

use App\Entity\LikeItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LikeItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikeItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikeItem[]    findAll()
 * @method LikeItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikeItem::class);
    }

    // /**
    //  * @return LikeItem[] Returns an array of LikeItem objects
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
    public function findOneBySomeField($value): ?LikeItem
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
