<?php

namespace App\Entity;

use App\Repository\ItemCollectionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemCollectionsRepository::class)]
class ItemCollections
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $descriptions;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'itemCollections')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'itemCollections')]
    #[ORM\JoinColumn(nullable: false)]
    private $author;

    #[ORM\Column(type: 'array', nullable: true)]
    private $items = [];

    #[ORM\Column(type: 'datetime')]
    private $datecreate;

    #[ORM\OneToMany(mappedBy: 'collectionID', targetEntity: CollectionsFull::class)]
    private $collectionsfullsID;

    public function __construct()
    {
        $this->collectionsfullsID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescriptions(): ?string
    {
        return $this->descriptions;
    }

    public function setDescriptions(?string $descriptions): self
    {
        $this->descriptions = $descriptions;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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

    public function getItems(): ?array
    {
        return $this->items;
    }

    public function setItems(?array $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function getDatecreate(): ?\DateTimeInterface
    {
        return $this->datecreate;
    }

    public function setDatecreate(\DateTimeInterface $datecreate): self
    {
        $this->datecreate = $datecreate;

        return $this;
    }

    /**
     * @return Collection|CollectionsFull[]
     */
    public function getCollectionsfullsID(): Collection
    {
        return $this->collectionsfullsID;
    }

    public function addCollectionsfullsID(CollectionsFull $collectionsfullsID): self
    {
        if (!$this->collectionsfullsID->contains($collectionsfullsID)) {
            $this->collectionsfullsID[] = $collectionsfullsID;
            $collectionsfullsID->setCollectionID($this);
        }

        return $this;
    }

    public function removeCollectionsfullsID(CollectionsFull $collectionsfullsID): self
    {
        if ($this->collectionsfullsID->removeElement($collectionsfullsID)) {
            // set the owning side to null (unless already changed)
            if ($collectionsfullsID->getCollectionID() === $this) {
                $collectionsfullsID->setCollectionID(null);
            }
        }

        return $this;
    }
}
