<?php


namespace App\Core\Manager;


use App\Core\Repository\OrderRepository;
use App\Core\SupplierFacade\Afterbuy\AfterbuySupplierFacade;

class OrdersImportManager
{
    private AfterbuySupplierFacade $afterbuySupplierFacade;

    private OrderRepository $orderRepository;

    public function __construct(AfterbuySupplierFacade $afterbuySupplierFacade, OrderRepository $orderRepository)
    {
        $this->afterbuySupplierFacade = $afterbuySupplierFacade;
        $this->orderRepository = $orderRepository;
    }

    public function importAll(): void
    {
        $orders = $this->afterbuySupplierFacade->getSoldItems();

        foreach ($orders as $order) {
            $this->orderRepository->save($order);
        }
    }
}