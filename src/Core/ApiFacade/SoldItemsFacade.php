<?php


namespace App\Core\ApiFacade;


use App\Api\Entity\Common\Collection\ApiSoldItemCollection;
use App\Api\Entity\Response\ApiSoldItemsResponse;
use App\Core\ApiFacade\Bridge\Response\SoldItemResponseBridge;
use App\Core\Repository\SoldItemRepository;

class SoldItemsFacade
{
    private SoldItemRepository $soldItemRepository;

    private SoldItemResponseBridge $soldItemResponseBridge;

    public function __construct(SoldItemRepository $soldItemRepository, SoldItemResponseBridge $soldItemResponseBridge)
    {
        $this->soldItemRepository = $soldItemRepository;
        $this->soldItemResponseBridge = $soldItemResponseBridge;
    }

    public function getAll(): ApiSoldItemsResponse
    {
        $soldItems = $this->soldItemRepository->findAll();

        $apiSoldItems = new ApiSoldItemCollection();
        foreach ($soldItems as $soldItem) {
            $apiSoldItem = $this->soldItemResponseBridge->build($soldItem);
            $apiSoldItems->add($apiSoldItem);
        }

        return new ApiSoldItemsResponse($apiSoldItems);
    }
}