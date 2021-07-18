<?php


namespace App\Supplier\Afterbuy\Common;


use JMS\Serializer\Annotation as Serializer;

class AfterbuyShopProductDetails
{
    /** @Serializer\Type("App\Supplier\Afterbuy\Common\AfterbuyBaseProductData") */
    private ?AfterbuyBaseProductData $BaseProductData = null;

    public function getBaseProductData(): ?AfterbuyBaseProductData
    {
        return $this->BaseProductData;
    }
}