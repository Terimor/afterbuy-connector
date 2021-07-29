<?php


namespace App\Core\ApiFacade\Bridge\Request;


use App\Api\Entity\Common\ApiCategory;
use App\Core\Entity\Category;
use App\Core\Repository\CategoryRepository;

class CategoryRequestBridge
{
    private CategoryRepository $categoryRepository;

    private CategoryRuleRequestBridge $categoryRuleRequestBridge;

    public function __construct(CategoryRepository $categoryRepository, CategoryRuleRequestBridge $categoryRuleRequestBridge)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryRuleRequestBridge = $categoryRuleRequestBridge;
    }

    public function build(ApiCategory $apiCategory): Category
    {
        $category = $this->categoryRepository->findOneById($apiCategory->getId());
        if (!$category) {
            $category = new Category();
        }

        $category->setName($apiCategory->getName());

        $category->getRules()->clear();
        foreach ($apiCategory->getRules() as $apiCategoryRule) {
            $categoryRule = $this->categoryRuleRequestBridge->build($apiCategoryRule);
            $category->addRule($categoryRule);
        }

        return $category;
    }
}