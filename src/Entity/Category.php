<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: ItemCollections::class)]
    private $itemCollections;

    public function __construct()
    {
        $this->collections = new ArrayCollection();
        $this->itemCollections = new ArrayCollection();
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

    /**
     * @return Collection|ItemCollections[]
     */
    public function getItemCollections(): Collection
    {
        return $this->itemCollections;
    }

    public function addItemCollection(ItemCollections $itemCollection): self
    {
        if (!$this->itemCollections->contains($itemCollection)) {
            $this->itemCollections[] = $itemCollection;
            $itemCollection->setCategory($this);
        }

        return $this;
    }

    public function removeItemCollection(ItemCollections $itemCollection): self
    {
        if ($this->itemCollections->removeElement($itemCollection)) {
            // set the owning side to null (unless already changed)
            if ($itemCollection->getCategory() === $this) {
                $itemCollection->setCategory(null);
            }
        }

        return $this;
    }

}
