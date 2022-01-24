<?php

namespace App\Entity;

use App\Repository\CommentariesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentariesRepository::class)]
class Commentaries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'commentariesID')]
    private $userID;

    #[ORM\ManyToOne(targetEntity: Items::class, inversedBy: 'commentariesID')]
    private $itemID;

    #[ORM\Column(type: 'datetime')]
    private $datecomment;

    #[ORM\Column(type: 'string', length: 255)]
    private $message;

    public function __construct()
    {
        $this->userID = new ArrayCollection();
        $this->itemID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserID(): Collection
    {
        return $this->userID;
    }

    public function addUserID(User $userID): self
    {
        if (!$this->userID->contains($userID)) {
            $this->userID[] = $userID;
        }

        return $this;
    }

    public function removeUserID(User $userID): self
    {
        $this->userID->removeElement($userID);

        return $this;
    }

    /**
     * @return Collection|Items[]
     */
    public function getItemID(): Collection
    {
        return $this->itemID;
    }

    public function addItemID(Items $itemID): self
    {
        if (!$this->itemID->contains($itemID)) {
            $this->itemID[] = $itemID;
        }

        return $this;
    }

    public function removeItemID(Items $itemID): self
    {
        $this->itemID->removeElement($itemID);

        return $this;
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
}
