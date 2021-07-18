<?php


namespace App\Core\SupplierFacade\Afterbuy\Bridge\Response\Common;


use App\Core\Entity\Order;
use App\Core\Repository\OrderRepository;
use App\Core\SupplierFacade\Exception\IgnoreCoreSupplierException;
use App\Supplier\Afterbuy\Common\AfterbuyOrder;

class AfterbuyOrderResponseBridge
{
    private OrderRepository $orderRepository;

    private AfterbuySoldItemResponseBridge $soldItemResponseBridge;

    public function __construct(OrderRepository $orderRepository, AfterbuySoldItemResponseBridge $soldItemResponseBridge)
    {
        $this->orderRepository = $orderRepository;
        $this->soldItemResponseBridge = $soldItemResponseBridge;
    }

    public function build(AfterbuyOrder $supplierOrder): Order
    {
        $existingOrder = $this->orderRepository->findOneByExternalId($supplierOrder->getOrderID());
        if ($existingOrder) {
            throw new IgnoreCoreSupplierException();
        }

        $order = new Order();

        $order->setExternalId($supplierOrder->getOrderID());
        foreach ($supplierOrder->getSoldItems() as $supplierSoldItem) {
            try {
                $soldItem = $this->soldItemResponseBridge->build($supplierSoldItem);
                $order->addSoldItem($soldItem);
            } catch (IgnoreCoreSupplierException $e) {
                continue;
            }
        }

        return $order;
    }
}