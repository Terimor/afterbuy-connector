<?php

namespace App\Core\Entity;

use App\Core\Entity\Collection\CategoryRuleCollection;
use App\Core\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="name",columns={"name"})})
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\OneToMany(targetEntity=SoldItem::class, mappedBy="category")
     */
    private Collection $soldItems;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity=CategoryRule::class, mappedBy="category", orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinColumn()
     */
    private Collection $rules;

    public function __construct()
    {
        $this->soldItems = new ArrayCollection();
        $this->rules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Collection|SoldItem[]
     */
    public function getSoldItems(): Collection
    {
        return $this->soldItems;
    }

    public function addSoldItem(SoldItem $soldItem): void
    {
        if (!$this->soldItems->contains($soldItem)) {
            $this->soldItems[] = $soldItem;
            $soldItem->setCategory($this);
        }
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Collection|CategoryRule[]
     */
    public function getRules(): Collection
    {
        return $this->rules;
    }

    public function getRulesCollection(): CategoryRuleCollection
    {
        return new CategoryRuleCollection($this->rules->toArray());
    }

    public function addRule(CategoryRule $categoryRule): void
    {
        if (!$this->rules->contains($categoryRule)) {
            $this->rules[] = $categoryRule;
            $categoryRule->setCategory($this);
        }
    }
}
