<?php


namespace App\Core\SupplierFacade\Afterbuy\Bridge\Response\GetSoldItems;


use App\Core\Entity\Collection\OrderCollection;
use App\Core\SupplierFacade\Afterbuy\Bridge\Response\Common\AfterbuyOrderResponseBridge;
use App\Core\SupplierFacade\Exception\IgnoreCoreSupplierException;
use App\Supplier\Afterbuy\Response\GetSoldItems\AfterbuyGetSoldItemsResponse;

class AfterbuyGetSoldItemsResponseBridge
{
    private AfterbuyOrderResponseBridge $orderResponseBridge;

    public function __construct(AfterbuyOrderResponseBridge $orderResponseBridge)
    {
        $this->orderResponseBridge = $orderResponseBridge;
    }

    public function build(AfterbuyGetSoldItemsResponse $response): OrderCollection
    {
        $orders = new OrderCollection();

        foreach ($response->getResult()->getOrders() as $supplierOrder) {
            try {
                $order = $this->orderResponseBridge->build($supplierOrder);
                if (!$order->getSoldItems()->isEmpty()) {
                    $orders->add($order);
                }
            } catch (IgnoreCoreSupplierException $e) {
                continue;
            }
        }

        return $orders;
    }
}