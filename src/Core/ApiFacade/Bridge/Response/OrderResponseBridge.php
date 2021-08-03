<?php


namespace App\Core\ApiFacade\Bridge\Response;


use App\Api\Entity\Common\ApiOrder;
use App\Core\Entity\Order;

class OrderResponseBridge
{
    public function build(Order $order): ApiOrder
    {
        $apiOrder = new ApiOrder();

        $apiOrder->setId($order->getId());
        $apiOrder->setDateTime($order->getDateTime());
        $apiOrder->setAfterbuyAccountName($order->getAfterbuyAccount()->getUserId());

        return $apiOrder;
    }
}