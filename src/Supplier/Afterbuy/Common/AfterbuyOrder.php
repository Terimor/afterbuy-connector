<?php


namespace App\Supplier\Afterbuy\Common;


use App\Supplier\Afterbuy\Collection\AfterbuySoldItemCollection;
use JMS\Serializer\Annotation as Serializer;

class AfterbuyOrder
{
    /** @Serializer\Type("int") */
    private int $OrderID;

    /**
     * @var AfterbuySoldItem[]|AfterbuySoldItemCollection
     * @Serializer\Type("array<App\Supplier\Afterbuy\Common\AfterbuySoldItem>")
     * @Serializer\XmlList(inline=false, entry="SoldItem")
     */
    private $SoldItems;

    public function getOrderID(): int
    {
        return $this->OrderID;
    }

    public function getSoldItems()
    {
        if (!$this->SoldItems instanceof AfterbuySoldItemCollection) {
            $this->SoldItems = new AfterbuySoldItemCollection($this->SoldItems);
        }

        return $this->SoldItems;
    }
}