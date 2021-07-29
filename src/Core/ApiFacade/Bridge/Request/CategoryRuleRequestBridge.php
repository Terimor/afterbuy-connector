<?php


namespace App\Core\ApiFacade\Bridge\Request;


use App\Api\Entity\Common\ApiCategoryRule;
use App\Core\ApiFacade\Bridge\BridgeConstants;
use App\Core\Entity\CategoryRule;
use App\Core\Entity\CategoryRuleEntry;

class CategoryRuleRequestBridge
{
    public function build(ApiCategoryRule $apiCategoryRule): CategoryRule
    {
        $categoryRule = new CategoryRule();

        $categoryRule->setIsExcluding($apiCategoryRule->isExcluding());
        $categoryRule->setIsActive($apiCategoryRule->isActive());

        $this->fillEntriesByString($categoryRule, $apiCategoryRule->getRule());

        return $categoryRule;
    }

    public function fillEntriesByString(CategoryRule $categoryRule, string $rule): void
    {
        foreach (explode(BridgeConstants::RULE_ENTRY_SPLIT_DELIMITER, $rule) as $ruleEntry) {
            $trimmedRuleEntry = trim($ruleEntry);
            $categoryRule->addEntry(new CategoryRuleEntry($trimmedRuleEntry));
        }
    }
}