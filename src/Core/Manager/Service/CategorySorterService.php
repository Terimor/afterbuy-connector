<?php


namespace App\Core\Manager\Service;


use App\Core\Entity\Category;
use App\Core\Entity\CategoryRule;
use App\Core\Entity\Collection\CategoryCollection;
use App\Core\Entity\SoldItem;

class CategorySorterService
{
    public function getAppropriateCategoryForSoldItem(SoldItem $soldItem, CategoryCollection $categories): ?Category
    {
        foreach ($categories as $category) {
            if ($this->isAppropriateCategory($soldItem, $category)) {
                return $category;
            }
        }

        return null;
    }

    private function isAppropriateCategory(SoldItem $soldItem, Category $category): bool
    {
        foreach ($category->getRulesCollection() as $rule) {
            if ($this->isAppropriateRule($soldItem, $rule)) {
                return true;
            }
        }

        return false;
    }

    private function isAppropriateRule(SoldItem $soldItem, CategoryRule $rule): bool
    {
        $entries = $rule->getEntryCollection();

        foreach ($entries->filterByIncluded() as $entry) {
            if (mb_stripos($soldItem->getTitle(), $entry->getEntry()) === false) {
                return false;
            }
        }

        foreach ($entries->filterByExcluded() as $entry) {
            if (mb_stripos($soldItem->getTitle(), $entry->getEntry()) !== false) {
                return false;
            }
        }

        return true;
    }
}