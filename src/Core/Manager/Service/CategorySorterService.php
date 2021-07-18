<?php


namespace App\Core\Manager\Service;


use App\Core\Entity\Category;
use App\Core\Entity\Collection\CategoryCollection;
use App\Core\Entity\SoldItem;

class CategorySorterService
{
    public function getAppropriateCategory(SoldItem $soldItem, CategoryCollection $categories): Category
    {

    }

    private function checkCategory(SoldItem $soldItem, Category $category): bool
    {

    }
}