<?php


namespace App\Core\ApiFacade;


use App\Api\Entity\Response\ApiCatalogsResponse;
use App\Core\ApiFacade\Bridge\Response\CatalogItemResponseBridge;
use App\Core\Repository\AfterbuyAccountRepository;
use App\Core\Repository\CategoryRepository;

class CatalogFacade
{
    private AfterbuyAccountRepository $afterbuyAccountRepository;

    private CategoryRepository $categoryRepository;

    private CatalogItemResponseBridge $catalogItemResponseBridge;

    public function __construct(
        AfterbuyAccountRepository $afterbuyAccountRepository,
        CategoryRepository $categoryRepository,
        CatalogItemResponseBridge $catalogItemResponseBridge
    ) {
        $this->afterbuyAccountRepository = $afterbuyAccountRepository;
        $this->categoryRepository = $categoryRepository;
        $this->catalogItemResponseBridge = $catalogItemResponseBridge;
    }

    public function getAll(): ApiCatalogsResponse
    {
        $catalogsResponse = new ApiCatalogsResponse();

        $afterbuyAccounts = $this->afterbuyAccountRepository->findAll();
        foreach ($afterbuyAccounts as $afterbuyAccount) {
            $catalogItem = $this->catalogItemResponseBridge->buildFromAfterbuyAccount($afterbuyAccount);
            $catalogsResponse->addAfterbuyAccount($catalogItem);
        }

        $categories = $this->categoryRepository->findAll();
        foreach ($categories as $category) {
            $catalogItem = $this->catalogItemResponseBridge->buildFromCategory($category);
            $catalogsResponse->addCategory($catalogItem);
        }

        return $catalogsResponse;
    }
}