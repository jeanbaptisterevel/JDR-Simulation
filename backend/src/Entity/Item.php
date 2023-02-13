<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ApiResource]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $type = null;

    #[ORM\ManyToMany(targetEntity: RPGClass::class, mappedBy: 'allowedItems')]
    private Collection $allowedRPGClasses;

    public function __construct()
    {
        $this->allowedRPGClasses = new ArrayCollection();
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

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, RPGClass>
     */
    public function getAllowedRPGClasses(): Collection
    {
        return $this->allowedRPGClasses;
    }

    public function addAllowedRPGClass(RPGClass $allowedRPGClass): self
    {
        if (!$this->allowedRPGClasses->contains($allowedRPGClass)) {
            $this->allowedRPGClasses->add($allowedRPGClass);
            $allowedRPGClass->addAllowedItem($this);
        }

        return $this;
    }

    public function removeAllowedRPGClass(RPGClass $allowedRPGClass): self
    {
        if ($this->allowedRPGClasses->removeElement($allowedRPGClass)) {
            $allowedRPGClass->removeAllowedItem($this);
        }

        return $this;
    }
}
