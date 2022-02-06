<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'datetime')]
    private $registerdate;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $status;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $lastactivity;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $avatar;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Items::class)]
    private $item;

    #[ORM\OneToMany(mappedBy: 'userID', targetEntity: Commentaries::class)]
    private $commentID;

    #[ORM\OneToMany(mappedBy: 'userID', targetEntity: LikeItem::class)]
    private $likeItems;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: ItemCollections::class)]
    private $itemCollections;

    #[ORM\OneToMany(mappedBy: 'userID', targetEntity: CollectionsFull::class)]
    private $collectionsfullID;

    public function __toString() {
        return $this->id;
    }

    public function __construct()
    {
        $this->item = new ArrayCollection();
        $this->commentID = new ArrayCollection();
        $this->likeItems = new ArrayCollection();
        $this->itemCollections = new ArrayCollection();
        $this->collectionsfullID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        //$roles[] = ["ROLE_USER"];

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getRegisterdate(): ?\DateTimeInterface
    {
        return $this->registerdate;
    }

    public function setRegisterdate(\DateTimeInterface $registerdate): self
    {
        $this->registerdate = $registerdate;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getLastactivity(): ?\DateTimeInterface
    {
        return $this->lastactivity;
    }

    public function setLastactivity(?\DateTimeInterface $lastactivity): self
    {
        $this->lastactivity = $lastactivity;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection|Items[]
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(Items $item): self
    {
        if (!$this->item->contains($item)) {
            $this->item[] = $item;
            $item->setAuthor($this);
        }

        return $this;
    }

    public function removeItem(Items $item): self
    {
        if ($this->item->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getAuthor() === $this) {
                $item->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaries[]
     */
    public function getCommentID(): Collection
    {
        return $this->commentID;
    }

    public function addCommentID(Commentaries $commentID): self
    {
        if (!$this->commentID->contains($commentID)) {
            $this->commentID[] = $commentID;
            $commentID->setUserID($this);
        }

        return $this;
    }

    public function removeCommentID(Commentaries $commentID): self
    {
        if ($this->commentID->removeElement($commentID)) {
            // set the owning side to null (unless already changed)
            if ($commentID->getUserID() === $this) {
                $commentID->setUserID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LikeItem[]
     */
    public function getLikeItems(): Collection
    {
        return $this->likeItems;
    }

    public function addLikeItem(LikeItem $likeItem): self
    {
        if (!$this->likeItems->contains($likeItem)) {
            $this->likeItems[] = $likeItem;
            $likeItem->setUserID($this);
        }

        return $this;
    }

    public function removeLikeItem(LikeItem $likeItem): self
    {
        if ($this->likeItems->removeElement($likeItem)) {
            // set the owning side to null (unless already changed)
            if ($likeItem->getUserID() === $this) {
                $likeItem->setUserID(null);
            }
        }

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
            $itemCollection->setAuthor($this);
        }

        return $this;
    }

    public function removeItemCollection(ItemCollections $itemCollection): self
    {
        if ($this->itemCollections->removeElement($itemCollection)) {
            // set the owning side to null (unless already changed)
            if ($itemCollection->getAuthor() === $this) {
                $itemCollection->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CollectionsFull[]
     */
    public function getCollectionsfullID(): Collection
    {
        return $this->collectionsfullID;
    }

    public function addCollectionsfullID(CollectionsFull $collectionsfullID): self
    {
        if (!$this->collectionsfullID->contains($collectionsfullID)) {
            $this->collectionsfullID[] = $collectionsfullID;
            $collectionsfullID->setUserID($this);
        }

        return $this;
    }

    public function removeCollectionsfullID(CollectionsFull $collectionsfullID): self
    {
        if ($this->collectionsfullID->removeElement($collectionsfullID)) {
            // set the owning side to null (unless already changed)
            if ($collectionsfullID->getUserID() === $this) {
                $collectionsfullID->setUserID(null);
            }
        }

        return $this;
    }
}
