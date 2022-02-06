<?php

namespace App\Repository;

use App\Entity\CollectionsFull;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollectionsFull|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectionsFull|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectionsFull[]    findAll()
 * @method CollectionsFull[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectionsFullRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectionsFull::class);
    }

    public function setCreateCollection(CollectionsFull $collectionsFull): object
    {
        $this->_em->persist($collectionsFull);
        $this->_em->flush();
        return $collectionsFull;
    }
    // /**
    //  * @return CollectionsFull[] Returns an array of CollectionsFull objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CollectionsFull
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
