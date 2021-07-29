<?php


namespace App\Core\ApiFacade\Bridge\Response;


use App\Api\Entity\Common\ApiCategoryRule;
use App\Core\ApiFacade\Bridge\BridgeConstants;
use App\Core\Entity\CategoryRule;

class CategoryRuleResponseBridge
{
    public function build(CategoryRule $categoryRule): ApiCategoryRule
    {
        $apiCategoryRule = new ApiCategoryRule();

        $apiCategoryRule->setId($categoryRule->getId());
        $apiCategoryRule->setIsActive($categoryRule->isActive());
        $apiCategoryRule->setIsExcluding($categoryRule->isExcluding());

        $ruleString = $this->buildRuleString($categoryRule);
        $apiCategoryRule->setRule($ruleString);

        return $apiCategoryRule;
    }

    private function buildRuleString(CategoryRule $categoryRule): string
    {
        $entries = [];

        foreach ($categoryRule->getEntryCollection() as $entry) {
            $entries[] = $entry->getEntry();
        }

        return implode(BridgeConstants::RULE_ENTRY_JOIN_DELIMITER, $entries);
    }
}