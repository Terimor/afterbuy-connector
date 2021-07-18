<?php


namespace App\Supplier\Afterbuy\Common;


use JMS\Serializer\Annotation as Serializer;

class AfterbuySoldItem
{
    /** @Serializer\Type("int") */
    private int $ItemID;

    /** @Serializer\Type("string") */
    private string $ItemTitle;

    /** @Serializer\Type("int") */
    private int $ItemQuantity;

    /** @Serializer\Type("App\Supplier\Afterbuy\Common\AfterbuyItemOriginalCurrency") */
    private AfterbuyItemOriginalCurrency $ItemOriginalCurrency;

    private ?AfterbuyShopProductDetails $ShopProductDetails = null;

    public function getItemID(): int
    {
        return $this->ItemID;
    }

    public function getItemTitle(): string
    {
        return $this->ItemTitle;
    }

    public function getItemQuantity(): int
    {
        return $this->ItemQuantity;
    }

    public function getItemOriginalCurrency(): AfterbuyItemOriginalCurrency
    {
        return $this->ItemOriginalCurrency;
    }

    public function getShopProductDetails(): ?AfterbuyShopProductDetails
    {
        return $this->ShopProductDetails;
    }
}