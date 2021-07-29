<?php


namespace App\Api\Entity\Common;


use App\Api\Entity\Common\Collection\ApiCategoryRuleCollection;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;

class ApiCategory
{
    /** @Serializer\Type("int") */
    private ?int $id = null;

    /** @Serializer\Type("string") */
    private string $name;

    /** @Serializer\Type("ArrayCollection<App\Api\Entity\Common\ApiCategoryRule>") */
    private ArrayCollection $rules;

    public function __construct()
    {
        $this->rules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRules(): ApiCategoryRuleCollection
    {
        return new ApiCategoryRuleCollection($this->rules->toArray());
    }

    public function addRule(ApiCategoryRule $categoryRule): void
    {
        $this->rules[] = $categoryRule;
    }
}