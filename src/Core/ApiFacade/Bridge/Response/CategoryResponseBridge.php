<?php


namespace App\Core\ApiFacade\Bridge\Response;


use App\Api\Entity\Common\ApiCategory;
use App\Core\Entity\Category;

class CategoryResponseBridge
{
    public function build(Category $category): ApiCategory
    {
        $apiCategory = new ApiCategory();

        $apiCategory->setId($category->getId());
        $apiCategory->setName($category->getName());

        return $apiCategory;
    }
}