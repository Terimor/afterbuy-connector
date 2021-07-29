<?php


namespace App\Core\ApiFacade\Bridge\Response;


use App\Api\Entity\Common\ApiCategory;
use App\Core\Entity\Category;

class CategoryResponseBridge
{
    private CategoryRuleResponseBridge $categoryRuleResponseBridge;

    public function __construct(CategoryRuleResponseBridge $categoryRuleResponseBridge)
    {
        $this->categoryRuleResponseBridge = $categoryRuleResponseBridge;
    }

    public function build(Category $category): ApiCategory
    {
        $apiCategory = new ApiCategory();

        $apiCategory->setId($category->getId());
        $apiCategory->setName($category->getName());

        foreach ($category->getRulesCollection() as $rule) {
            $apiRule = $this->categoryRuleResponseBridge->build($rule);
            $apiCategory->addRule($apiRule);
        }

        return $apiCategory;
    }
}