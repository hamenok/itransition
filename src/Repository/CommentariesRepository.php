<?php

namespace App\Repository;

use App\Entity\Commentaries;
use App\Entity\Items;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commentaries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaries[]    findAll()
 * @method Commentaries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentariesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaries::class);
    }

    public function addComment(Commentaries $comment,$msg,$user,$item): void
    {
        $comment->setMessage($msg);
        $comment->setUserID($user);
        $comment->setItemID($item);
        $comment->setDatecomment(date_timezone_set(new \DateTime(), new \DateTimeZone('+3UTC')));
        $this->_em->persist($comment);
        $this->_em->flush();
    }

    public function getCommentaries(int $itemID): array
    {
        $query = $this->createQueryBuilder('c')
        ->select('c.message, c.datecomment,
                 u.email, u.avatar')
        ->join(User::class, 'u', 'with','c.userID=u.id')
        ->join(Items::class, 'i', 'with','c.itemID=i.id')
        ->where('c.itemID = :id') 
        ->setParameter('id', $itemID)
        ->getQuery();

        return $query->getArrayResult();
    }
    // /**
    //  * @return Commentaries[] Returns an array of Commentaries objects
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
    public function findOneBySomeField($value): ?Commentaries
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
