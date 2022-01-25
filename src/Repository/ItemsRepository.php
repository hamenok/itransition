<?php

namespace App\Repository;

use App\Entity\Items;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Items|null find($id, $lockMode = null, $lockVersion = null)
 * @method Items|null findOneBy(array $criteria, array $orderBy = null)
 * @method Items[]    findAll()
 * @method Items[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Items::class);
    }

    public function getAllMyItems(int $userID)
    {
        return parent::findBy(
            ['author' => $userID]
        );
    }

    public function setUpdateItem(Items $item): object
    {
        $this->_em->flush();
        return $item;
    }

    public function setCreateItem(Items $item, User $user): object
    {
        $item->setAuthor($user);
        $item->setDatecreateitem(date_timezone_set(new \DateTime(), new \DateTimeZone('+3UTC')));
        $this->_em->persist($item);
        $this->_em->flush();
        return $item;
    }


    // /**
    //  * @return Items[] Returns an array of Items objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Items
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
