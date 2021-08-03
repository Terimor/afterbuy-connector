<?php


namespace App\Api\Entity\Response;


use App\Api\Entity\Common\ApiCatalogItem;
use App\Api\Entity\Common\Collection\ApiCatalogItemCollection;
use JMS\Serializer\Annotation as Serializer;

class ApiCatalogsResponse extends ApiSuccessResponse
{
    /** @Serializer\Type("ArrayCollection<App\Api\Entity\Common\ApiCatalogItem>") */
    private ApiCatalogItemCollection $afterbuyAccounts;

    /** @Serializer\Type("ArrayCollection<App\Api\Entity\Common\ApiCatalogItem>") */
    private ApiCatalogItemCollection $categories;

    public function __construct()
    {
        $this->afterbuyAccounts = new ApiCatalogItemCollection();
        $this->categories = new ApiCatalogItemCollection();
    }

    public function addAfterbuyAccount(ApiCatalogItem $catalogItem): void
    {
        $this->afterbuyAccounts->add($catalogItem);
    }

    public function addCategory(ApiCatalogItem $catalogItem): void
    {
        $this->categories->add($catalogItem);
    }
}