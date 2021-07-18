<?php


namespace App\Supplier\Afterbuy\Request\GetSoldItems;


use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("Request")
 */
class AfterbuyGetSoldItemsRequest
{
    /** @Serializer\Type("App\Supplier\Afterbuy\Request\GetSoldItems\AfterbuyGlobalRequest") */
    private AfterbuyGlobalRequest $AfterbuyGlobal;

    /** @Serializer\Type("int") */
    private int $RequestAllItems;

    public function setAfterbuyGlobal(AfterbuyGlobalRequest $AfterbuyGlobal): void
    {
        $this->AfterbuyGlobal = $AfterbuyGlobal;
    }

    public function setRequestAllItems(int $RequestAllItems): void
    {
        $this->RequestAllItems = $RequestAllItems;
    }
}