<?php

namespace App\Repository;

use App\Entity\ItemCollections;
use App\Entity\User;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ItemCollections|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemCollections|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemCollections[]    findAll()
 * @method ItemCollections[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemCollectionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemCollections::class);
    }

    public function setCreateCollection(ItemCollections $itemCollections, User $user): object
    {
        $itemCollections->setAuthor($user);
        $itemCollections->setDatecreate(date_timezone_set(new \DateTime(), new \DateTimeZone('+3UTC')));
        $this->_em->persist($itemCollections);
        $this->_em->flush();
        return $itemCollections;
    }

    public function getAllMyCollection(int $userID)
    {
        $query = $this->createQueryBuilder('c')
            ->select('c.id, c.title, c.descriptions, k.title as category')
            ->join(User::class, 'u', 'with','c.author=u.id')
            ->join(Category::class, 'k', 'with','k.id=c.category') 
            ->where('u.id = :id') 
            ->setParameter('id', $userID)
            ->getQuery();

        return $query->getArrayResult();
    }
}
