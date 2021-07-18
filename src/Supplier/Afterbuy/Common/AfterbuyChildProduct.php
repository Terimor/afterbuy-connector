<?php


namespace App\Supplier\Afterbuy\Common;


use JMS\Serializer\Annotation as Serializer;

class AfterbuyChildProduct
{
    /** @Serializer\Type("string") */
    private string $ProductName;

    public function getProductName(): string
    {
        return $this->ProductName;
    }
}