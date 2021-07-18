<?php


namespace App\Supplier\Afterbuy\Response\GetSoldItems;


use App\Supplier\Afterbuy\Collection\AfterbuyOrderCollection;
use App\Supplier\Afterbuy\Common\AfterbuyOrder;
use JMS\Serializer\Annotation as Serializer;

class AfterbuyResultResponse
{
    /**
     * @var AfterbuyOrder[]|AfterbuyOrderCollection
     * @Serializer\Type("array<App\Supplier\Afterbuy\Common\AfterbuyOrder>")
     * @Serializer\XmlList(inline=false, entry="Order")
     */
    private $Orders = [];

    public function getOrders(): AfterbuyOrderCollection
    {
        if (!$this->Orders instanceof AfterbuyOrderCollection) {
            $this->Orders = new AfterbuyOrderCollection($this->Orders);
        }

        return $this->Orders;
    }
}