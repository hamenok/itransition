<?php

namespace App\Entity;

use App\Repository\CommentariesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentariesRepository::class)]
class Commentaries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $datecomment;

    #[ORM\Column(type: 'string', length: 255)]
    private $message;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'commentID')]
    #[ORM\JoinColumn(nullable: false)]
    private $userID;

    #[ORM\ManyToOne(targetEntity: Items::class, inversedBy: 'commentID')]
    #[ORM\JoinColumn(nullable: false)]
    private $itemID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatecomment(): ?\DateTimeInterface
    {
        return $this->datecomment;
    }

    public function setDatecomment(\DateTimeInterface $datecomment): self
    {
        $this->datecomment = $datecomment;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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
