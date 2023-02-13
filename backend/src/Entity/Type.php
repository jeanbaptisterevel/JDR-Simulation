<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource]
class Type
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $name = null;

  #[ORM\Column(length: 8192)]
  private ?string $attributes = null;

  private ?array $characteristics = null;


  #[ORM\OneToMany(mappedBy: 'type', targetEntity: Item::class)]
  private Collection $items;

  public function __construct()
  {
    $this->items = new ArrayCollection();
  }

  #[ORM\PostLoad]
  public function generateCharacteristicsOnPostLoad(): void
  {
    if ($this->attributes !== null) {
        $this->characteristics = $this->translateAttributes($this->attributes);
    }
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

  public function getAttributes(): ?string
  {
    return $this->attributes;
  }

  /**
   * @return array|null
   */
  public function getCharacteristics(): ?array
  {
    return $this->characteristics;
  }

  public function setCharacteristics(array $characteristics): self
  {
    $this->characteristics = $characteristics;
    $this->attributes = $this->translateCharacteristics($characteristics);

    return $this;
  }

  public function hasCharacteristics(): bool
  {
    return $this->characteristics !== null;
  }

  public function setAttributes(string $attributes): self
  {
    $this->attributes = $attributes;
    $this->characteristics = $this->translateAttributes($attributes);

    return $this;
  }

  /**
   * @return Collection<int, Item>
   */
  public function getItems(): Collection
  {
    return $this->items;
  }

  public function addItem(Item $item): self
  {
    if (!$this->items->contains($item)) {
      $this->items->add($item);
      $item->setType($this);
    }

    return $this;
  }

  public function removeItem(Item $item): self
  {
    if ($this->items->removeElement($item)) {
      // set the owning side to null (unless already changed)
      if ($item->getType() === $this) {
        $item->setType(null);
      }
    }

    return $this;
  }

  private function translateAttributes(string $attributes): array|null
  {
    try {
      return json_decode($attributes, true, 512, JSON_THROW_ON_ERROR) ?: null;
    } catch (\JsonException $e) {
      throw new \RuntimeException('Erreur de décodage JSON : ' . $troubles->getMessage());
    }
  }

  private function translateCharacteristics(array $attributes): string|null
  {
    try {
      return json_encode($attributes,  JSON_THROW_ON_ERROR) ?: null;
    } catch (\JsonException $e) {
      throw new \RuntimeException('Erreur de décodage JSON : ' . $troubles->getMessage());
    }
  }
}
