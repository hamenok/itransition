<?php

namespace App\Repository;

use App\Entity\LikeItem;
use App\Entity\Items;
use App\Entity\User;
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

    public function addLike(LikeItem $like, $userID,$itemID)
    {
        $like->setUserID($userID);
        $like->setItemID($itemID);
        $this->_em->persist($like);
        $this->_em->flush();
    }

    public function delLike(LikeItem $like)
    {
        
        $this->_em->remove($like);
        $this->_em->flush();
    }
    
    public function getAllLike(int $itemID): array
    {
        $query = $this->createQueryBuilder('l')
        ->select('l.id') 
        ->join(Items::class, 'i', 'with','l.itemID=i.id') 
        ->where('l.itemID = :itemID')
        ->setParameter('itemID', $itemID)
        ->getQuery();

        return $query->getArrayResult();
    }

    public function getLikeUser(int $itemID, int $userID)
    {
        $query = $this->createQueryBuilder('l')
        ->select('l.id')
        ->join(User::class, 'u', 'with','l.userID=u.id') 
        ->join(Items::class, 'i', 'with','l.itemID=i.id') 
        ->where('l.userID = :userID and l.itemID = :itemID') 
        ->setParameter('userID', $userID)
        ->setParameter('itemID', $itemID)
        ->getQuery();

        return $query->getArrayResult();
    }

    public function getOne(int $like): object
    {
        return parent::find($like);
    }

    public function getAll(): array
    {
        return parent::findAll();
    }
}