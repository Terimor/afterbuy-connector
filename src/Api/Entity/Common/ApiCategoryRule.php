<?php


namespace App\Api\Entity\Common;


use JMS\Serializer\Annotation as Serializer;

class ApiCategoryRule
{
    /** @Serializer\Type("int") */
    private ?int $id = null;

    /** @Serializer\Type("bool") */
    private bool $isExcluding;

    /** @Serializer\Type("bool") */
    private bool $isActive;

    /** @Serializer\Type("string") */
    private string $rule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
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

    public function getRule(): string
    {
        return $this->rule;
    }

    public function setRule(string $rule): void
    {
        $this->rule = $rule;
    }
}