<?php


namespace App\Core\ApiFacade\Bridge\Response;


use App\Api\Entity\Common\ApiCatalogItem;
use App\Core\Entity\AfterbuyAccount;
use App\Core\Entity\Category;

class CatalogItemResponseBridge
{
    public function buildFromAfterbuyAccount(AfterbuyAccount $afterbuyAccount): ApiCatalogItem
    {
        $catalogItem = new ApiCatalogItem();

        $catalogItem->setId($afterbuyAccount->getId());
        $catalogItem->setLabel($afterbuyAccount->getUserId());

        return $catalogItem;
    }

    public function buildFromCategory(Category $category): ApiCatalogItem
    {
        $catalogItem = new ApiCatalogItem();

        $catalogItem->setId($category->getId());
        $catalogItem->setLabel($category->getName());

        return $catalogItem;
    }
}