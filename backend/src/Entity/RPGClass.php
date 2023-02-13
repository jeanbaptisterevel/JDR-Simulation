<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RPGClassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RPGClassRepository::class)]
#[ApiResource]
class RPGClass
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $name = null;

  #[ORM\Column(length: 255)]
  private ?string $base_health = null;

  #[ORM\Column(length: 255)]
  private ?string $base_force = null;

  #[ORM\Column(length: 255)]
  private ?string $base_dext = null;

  #[ORM\Column(length: 255)]
  private ?string $base_const = null;

  #[ORM\Column(length: 255)]
  private ?string $base_intell = null;

  #[ORM\Column(length: 255)]
  private ?string $base_wisdom = null;

  #[ORM\Column(length: 255)]
  private ?string $base_charisma = null;

  #[ORM\ManyToMany(targetEntity: "Item")]
  #[ORM\JoinTable(name: "allowed_items")]
  #[ORM\JoinColumn(name: 'rpgclass_id', referencedColumnName: 'id')]
  #[ORM\InverseJoinColumn(name: 'item_id', referencedColumnName: 'id')]
  private Collection $allowedItems;

  #[ORM\ManyToMany(targetEntity: Item::class)]
  #[ORM\JoinTable(name: "starting_items")]
  #[ORM\JoinColumn(name: 'rpgclass_id', referencedColumnName: 'id')]
  #[ORM\InverseJoinColumn(name: 'item_id', referencedColumnName: 'id')]
  private Collection $startingItems;

  public function __construct()
  {
    $this->allowedItems = new ArrayCollection();
    $this->startingItems = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getBaseHealth(): ?string
  {
    return $this->base_health;
  }

  public function setBaseHealth(string $base_health): self
  {
    $this->base_health = $base_health;

    return $this;
  }

  public function getBaseForce(): ?string
  {
    return $this->base_force;
  }

  public function setBaseForce(string $base_force): self
  {
    $this->base_force = $base_force;

    return $this;
  }

  public function getBaseDext(): ?string
  {
    return $this->base_dext;
  }

  public function setBaseDext(string $base_dext): self
  {
    $this->base_dext = $base_dext;

    return $this;
  }

  public function getBaseConst(): ?string
  {
    return $this->base_const;
  }

  public function setBaseConst(string $base_const): self
  {
    $this->base_const = $base_const;

    return $this;
  }

  public function getBaseIntell(): ?string
  {
    return $this->base_intell;
  }

  public function setBaseIntell(string $base_intell): self
  {
    $this->base_intell = $base_intell;

    return $this;
  }

  public function getBaseWisdom(): ?string
  {
    return $this->base_wisdom;
  }

  public function setBaseWisdom(string $base_wisdom): self
  {
    $this->base_wisdom = $base_wisdom;

    return $this;
  }

  public function getBaseCharisma(): ?string
  {
    return $this->base_charisma;
  }

  public function setBaseCharisma(string $base_charisma): self
  {
    $this->base_charisma = $base_charisma;

    return $this;
  }

  /**
   * @return Collection<int, Item>
   */
  public function getAllowedItems(): Collection
  {
    return $this->allowedItems;
  }

  public function addAllowedItems(array $allowedItems): self
  {
    foreach ($allowedItems as $item) {
      $this->addAllowedItem($item);
    }

    return $this;
  }

  public function addAllowedItem(Item $allowedItem): self
  {
    if (!$this->allowedItems->contains($allowedItem)) {
      $this->allowedItems->add($allowedItem);
    }

    return $this;
  }

  public function removeAllowedItems(array $allowedItems): self
  {
    foreach ($allowedItems as $item) {
      $this->removeAllowedItem($item);
    }

    return $this;
  }
  public function removeAllowedItem(Item $allowedItem): self
  {
    $this->allowedItems->removeElement($allowedItem);

    return $this;
  }

  /**
   * @return Collection<int, Item>
   */
  public function getStartingItems(): Collection
  {
    return $this->startingItems;
  }

  public function addStartingItems(array $startingItems): self
  {
    foreach ($startingItems as $item) {
      $this->addStartingItem($item);
    }

    return $this;
  }

  public function addStartingItem(Item $startingItem): self
  {
    if (!$this->startingItems->contains($startingItem)) {
      $this->startingItems->add($startingItem);
    }

    return $this;
  }

  public function removeStartingItems(array $startingItems): self
  {
    foreach ($startingItems as $item) {
      $this->removeStartingItem($item);
    }

    return $this;
  }

  public function removeStartingItem(Item $startingItem): self
  {
    $this->startingItems->removeElement($startingItem);

    return $this;
  }
}
