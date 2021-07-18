<?php


namespace App\Core\SupplierFacade\Afterbuy\Bridge\Response\Common;


use App\Core\Entity\SoldItem;
use App\Core\SupplierFacade\Exception\IgnoreCoreSupplierException;
use App\Supplier\Afterbuy\Common\AfterbuySoldItem;

class AfterbuySoldItemResponseBridge
{
    private const COMBINED_TITLE_PATTERN = '%s - %s';

    public function build(AfterbuySoldItem $supplierSoldItem): SoldItem
    {
        $soldItem = new SoldItem();

        $soldItem->setExternalId($supplierSoldItem->getItemID());
        $soldItem->setQuantity($supplierSoldItem->getItemQuantity());
        $soldItem->setTitle($this->buildTitle($supplierSoldItem));

        $price = $supplierSoldItem->getItemOriginalCurrency()->getItemPrice();
        if ($price >= 0) {
            $soldItem->setPrice($supplierSoldItem->getItemOriginalCurrency()->getItemPrice());
        } else {
            throw new IgnoreCoreSupplierException();
        }

        return $soldItem;
    }

    private function buildTitle(AfterbuySoldItem $supplierSoldItem): string
    {
        $title = $supplierSoldItem->getItemTitle();
        $additionalTitle = null;

        $shopProductDetails = $supplierSoldItem->getShopProductDetails();
        if ($shopProductDetails) {
            $baseProductData = $shopProductDetails->getBaseProductData();
            if ($baseProductData) {
                $childProduct = $baseProductData->getChildProduct();
                if ($childProduct) {
                    $additionalTitle = $childProduct->getProductName();
                }
            }
        }
        if ($additionalTitle) {
            return sprintf(self::COMBINED_TITLE_PATTERN, $title, $additionalTitle);
        }

        return $title;
    }
}