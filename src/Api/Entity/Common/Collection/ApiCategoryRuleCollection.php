<?php


namespace App\Api\Entity\Common\Collection;


use App\Api\Entity\Common\ApiCategoryRule;
use App\Base\AbstractCollection;

class ApiCategoryRuleCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return ApiCategoryRule::class;
    }
}