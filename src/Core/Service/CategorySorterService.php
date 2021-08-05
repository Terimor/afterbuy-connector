<?php


namespace App\Core\Service;


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
        $activeRules = $category->getRulesCollection()->filterActive();

        foreach ($activeRules->filterExcluding() as $excludingRule) {
            if (!$this->isAppropriateExcludingRule($soldItem, $excludingRule)) {
                return false;
            }
        }

        foreach ($activeRules->filterIncluding() as $includingRule) {
            if ($this->isAppropriateIncludingRule($soldItem, $includingRule)) {
                return true;
            }
        }

        return false;
    }

    private function isAppropriateExcludingRule(SoldItem $soldItem, CategoryRule $excludingRule): bool
    {
        foreach ($excludingRule->getEntryCollection() as $ruleEntry) {
            if (mb_stripos($ruleEntry->getEntry(), $soldItem->getTitle()) !== false) {
                return false;
            }
        }

        return true;
    }

    private function isAppropriateIncludingRule(SoldItem $soldItem, CategoryRule $includingRule): bool
    {
        foreach ($includingRule->getEntryCollection() as $ruleEntry) {
            if (mb_stripos($ruleEntry->getEntry(), $soldItem->getTitle()) === false) {
                return false;
            }
        }

        return true;
    }
}