<?php

namespace App\Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class CategoryRuleEntry
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $entry;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryRule::class, inversedBy="entries")
     * @ORM\JoinColumn(nullable=false)
     */
    private CategoryRule $categoryRule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntry(): string
    {
        return $this->entry;
    }

    public function setEntry(string $entry): void
    {
        $this->entry = $entry;
    }

    public function getCategoryRule(): CategoryRule
    {
        return $this->categoryRule;
    }

    public function setCategoryRule(CategoryRule $categoryRule): void
    {
        $this->categoryRule = $categoryRule;
    }
}
