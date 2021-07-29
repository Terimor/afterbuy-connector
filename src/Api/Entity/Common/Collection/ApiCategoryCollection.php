<?php


namespace App\Api\Entity\Common\Collection;


use App\Api\Entity\Common\ApiCategory;
use App\Base\AbstractCollection;

class ApiCategoryCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return ApiCategory::class;
    }
}