<?php


namespace App\Api\Entity\Common\Collection;


use App\Api\Entity\Common\ApiCatalogItem;
use App\Base\AbstractCollection;

class ApiCatalogItemCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return ApiCatalogItem::class;
    }
}