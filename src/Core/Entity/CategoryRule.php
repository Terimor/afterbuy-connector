<?php

namespace App\Core\Entity;

use App\Core\Entity\Collection\CategoryRuleEntryCollection;
use App\Core\Repository\CategoryRuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRuleRepository::class)
 */
class CategoryRule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="categoryRules")
     * @ORM\JoinColumn(nullable=false)
     */
    private Category $category;

    /**
     * @ORM\OneToMany(targetEntity=CategoryRuleEntry::class, mappedBy="categoryRule", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private Collection $entries;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isExcluding;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isActive;

    public function __construct()
    {
        $this->entries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return Collection|CategoryRuleEntry[]
     */
    public function getEntries(): Collection
    {
        return $this->entries;
    }

    public function getEntryCollection(): CategoryRuleEntryCollection
    {
        return new CategoryRuleEntryCollection($this->entries->toArray());
    }

    public function addEntry(CategoryRuleEntry $entry): void
    {
        if (!$this->entries->contains($entry)) {
            $this->entries[] = $entry;
            $entry->setCategoryRule($this);
        }
    }

    public function isExcluding(): bool
    {
        return $this->isExcluding;
    }

    public function setIsExcluding(bool $isExcluding): void
    {
        $this->isExcluding = $isExcluding;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }
}
