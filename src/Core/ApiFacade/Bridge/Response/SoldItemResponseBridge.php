<?php


namespace App\Core\ApiFacade\Bridge\Response;


use App\Api\Entity\Common\ApiSoldItem;
use App\Core\Entity\SoldItem;

class SoldItemResponseBridge
{
    private CategoryResponseBridge $categoryResponseBridge;

    private VolumeResponseBridge $volumeResponseBridge;

    private OrderResponseBridge $orderResponseBridge;

    public function __construct(
        CategoryResponseBridge $categoryResponseBridge,
        VolumeResponseBridge $volumeResponseBridge,
        OrderResponseBridge $orderResponseBridge
    ) {
        $this->categoryResponseBridge = $categoryResponseBridge;
        $this->volumeResponseBridge = $volumeResponseBridge;
        $this->orderResponseBridge = $orderResponseBridge;
    }

    public function build(SoldItem $soldItem): ApiSoldItem
    {
        $apiSoldItem = new ApiSoldItem();

        $apiSoldItem->setId($soldItem->getId());
        $apiSoldItem->setTitle($soldItem->getTitle());
        $apiSoldItem->setQuantity($soldItem->getQuantity());
        $apiSoldItem->setPrice($soldItem->getPrice());

        $category = $soldItem->getCategory();
        if ($category) {
            $apiCategory = $this->categoryResponseBridge->build($category);
            $apiSoldItem->setCategory($apiCategory);
        }

        $volume = $soldItem->getVolume();
        if ($volume) {
            $apiVolume = $this->volumeResponseBridge->build($volume);
            $apiSoldItem->setVolume($apiVolume);
        }

        $apiOrder = $this->orderResponseBridge->build($soldItem->getOrder());
        $apiSoldItem->setOrder($apiOrder);

        $apiSoldItem->setProductCode($soldItem->getProductCode());

        return $apiSoldItem;
    }
}