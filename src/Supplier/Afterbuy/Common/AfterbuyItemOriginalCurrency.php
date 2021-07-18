<?php


namespace App\Supplier\Afterbuy\Common;


use JMS\Serializer\Annotation as Serializer;

class AfterbuyItemOriginalCurrency
{
    /** @Serializer\Type("float") */
    private float $ItemPrice;

    public function getItemPrice(): float
    {
        return $this->ItemPrice;
    }
}