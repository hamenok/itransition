<?php

namespace App\Entity;

use App\Repository\CollectionsFullRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectionsFullRepository::class)]
class CollectionsFull
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: ItemCollections::class, inversedBy: 'collectionsfullsID')]
    #[ORM\JoinColumn(nullable: false)]
    private $collectionID;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'collectionsfullID')]
    #[ORM\JoinColumn(nullable: false)]
    private $userID;

    #[ORM\ManyToOne(targetEntity: Items::class, inversedBy: 'collectionsfullID')]
    #[ORM\JoinColumn(nullable: false)]
    private $itemID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollectionID(): ?ItemCollections
    {
        return $this->collectionID;
    }

    public function setCollectionID(?ItemCollections $collectionID): self
    {
        $this->collectionID = $collectionID;

        return $this;
    }

    public function getUserID(): ?User
    {
        return $this->userID;
    }

    public function setUserID(?User $userID): self
    {
        $this->userID = $userID;

        return $this;
    }

    public function getItemID(): ?Items
    {
        return $this->itemID;
    }

    public function setItemID(?Items $itemID): self
    {
        $this->itemID = $itemID;

        return $this;
    }
}
