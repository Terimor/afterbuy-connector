<?php


namespace App\Supplier\Afterbuy\Common;


use JMS\Serializer\Annotation as Serializer;

class AfterbuyBaseProductData
{
    /** @Serializer\Type("App\Supplier\Afterbuy\Common\AfterbuyChildProduct") */
    private ?AfterbuyChildProduct $ChildProduct = null;

    public function getChildProduct(): ?AfterbuyChildProduct
    {
        return $this->ChildProduct;
    }
}