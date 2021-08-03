<?php


namespace App\Supplier\Afterbuy\Common;


use App\Supplier\Afterbuy\Collection\AfterbuySoldItemCollection;
use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class AfterbuyOrder
{
    /** @Serializer\Type("int") */
    private int $OrderID;

    /** @Serializer\Type("DateTimeImmutable<'d.m.Y H:i:s'>") */
    private DateTimeImmutable $OrderDate;

    /**
     * @var AfterbuySoldItem[]|AfterbuySoldItemCollection
     * @Serializer\Type("array<App\Supplier\Afterbuy\Common\AfterbuySoldItem>")
     * @Serializer\XmlList(inline=false, entry="SoldItem")
     */
    private $SoldItems = [];

    public function getOrderID(): int
    {
        return $this->OrderID;
    }

    public function getOrderDate(): DateTimeImmutable
    {
        return $this->OrderDate;
    }

    public function getSoldItems(): AfterbuySoldItemCollection
    {
        if (!$this->SoldItems instanceof AfterbuySoldItemCollection) {
            $this->SoldItems = new AfterbuySoldItemCollection($this->SoldItems);
        }

        return $this->SoldItems;
    }
}