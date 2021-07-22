<?php


namespace App\Core\ApiFacade\Bridge\Response;


use App\Api\Entity\Common\ApiSoldItem;
use App\Core\Entity\SoldItem;

class SoldItemResponseBridge
{
    private CategoryResponseBridge $categoryResponseBridge;

    private VolumeResponseBridge $volumeResponseBridge;

    public function __construct(CategoryResponseBridge $categoryResponseBridge, VolumeResponseBridge $volumeResponseBridge)
    {
        $this->categoryResponseBridge = $categoryResponseBridge;
        $this->volumeResponseBridge = $volumeResponseBridge;
    }

    public function build(SoldItem $soldItem): ApiSoldItem
    {
        $apiSoldItem = new ApiSoldItem();

        $apiSoldItem->setId($soldItem->getId());
        $apiSoldItem->setTitle($soldItem->getTitle());
        $apiSoldItem->setQuantity($soldItem->getQuantity());
        $apiSoldItem->setOrderId($soldItem->getOrder()->getId());
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

        return $apiSoldItem;
    }
}