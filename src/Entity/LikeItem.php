<?php

namespace App\Entity;

use App\Repository\LikeItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeItemRepository::class)]
class LikeItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'likeItems')]
    #[ORM\JoinColumn(nullable: false)]
    private $userID;

    #[ORM\ManyToOne(targetEntity: Items::class, inversedBy: 'likeItems')]
    #[ORM\JoinColumn(nullable: false)]
    private $itemID;

    public function getId(): ?int
    {
        return $this->id;
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
