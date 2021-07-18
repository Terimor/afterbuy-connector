<?php

namespace App\Core\Entity;

use App\Core\Repository\CategoryRuleRepository;
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
     * @ORM\Column(type="string", length=255)
     */
    private string $entry;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isStop;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="categoryRules")
     * @ORM\JoinColumn(nullable=false)
     */
    private Category $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntry(): ?string
    {
        return $this->entry;
    }

    public function setEntry(string $entry): void
    {
        $this->entry = $entry;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function isStop(): bool
    {
        return $this->isStop;
    }

    public function setIsStop(bool $isStop): void
    {
        $this->isStop = $isStop;
    }
}
