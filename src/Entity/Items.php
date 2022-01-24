<?php

namespace App\Entity;

use App\Repository\ItemsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemsRepository::class)]
class Items
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nameItem;

    #[ORM\Column(type: 'array', nullable: true)]
    private $tagItem = [];

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imageItems;

    #[ORM\ManyToMany(targetEntity: Commentaries::class, mappedBy: 'itemID')]
    private $commentariesID;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'item')]
    #[ORM\JoinColumn(nullable: false)]
    private $author;

    #[ORM\Column(type: 'datetime')]
    private $datecreateitem;

    public function __construct()
    {
        $this->commentariesID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameItem(): ?string
    {
        return $this->nameItem;
    }

    public function setNameItem(string $nameItem): self
    {
        $this->nameItem = $nameItem;

        return $this;
    }

    public function getTagItem(): ?array
    {
        return $this->tagItem;
    }

    public function setTagItem(?array $tagItem): self
    {
        $this->tagItem = $tagItem;

        return $this;
    }

    public function getImageItems(): ?string
    {
        return $this->imageItems;
    }

    public function setImageItems(string $imageItems): self
    {
        $this->imageItems = $imageItems;

        return $this;
    }

    /**
     * @return Collection|Commentaries[]
     */
    public function getCommentariesID(): Collection
    {
        return $this->commentariesID;
    }

    public function addCommentariesID(Commentaries $commentariesID): self
    {
        if (!$this->commentariesID->contains($commentariesID)) {
            $this->commentariesID[] = $commentariesID;
            $commentariesID->addItemID($this);
        }

        return $this;
    }

    public function removeCommentariesID(Commentaries $commentariesID): self
    {
        if ($this->commentariesID->removeElement($commentariesID)) {
            $commentariesID->removeItemID($this);
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getDatecreateitem(): ?\DateTimeInterface
    {
        return $this->datecreateitem;
    }

    public function setDatecreateitem(\DateTimeInterface $datecreateitem): self
    {
        $this->datecreateitem = $datecreateitem;

        return $this;
    }
}
