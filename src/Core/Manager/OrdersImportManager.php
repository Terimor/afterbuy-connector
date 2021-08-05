<?php


namespace App\Core\Manager;


use App\Core\Entity\AfterbuyAccount;
use App\Core\Entity\Collection\OrderCollection;
use App\Core\Service\CategorySorterService;
use App\Core\Service\ProductCodeParserService;
use App\Core\Service\VolumeParserService;
use App\Core\Repository\AfterbuyAccountRepository;
use App\Core\Repository\CategoryRepository;
use App\Core\Repository\OrderRepository;
use App\Core\SupplierFacade\Afterbuy\AfterbuySupplierFacade;

class OrdersImportManager
{
    private AfterbuySupplierFacade $afterbuySupplierFacade;

    private OrderRepository $orderRepository;

    private CategorySorterService $categorySorterService;

    private CategoryRepository $categoryRepository;

    private VolumeParserService $volumeParserService;

    private ProductCodeParserService $productCodeParserService;

    private AfterbuyAccountRepository $afterbuyAccountRepository;

    public function __construct(
        AfterbuySupplierFacade $afterbuySupplierFacade,
        OrderRepository $orderRepository,
        CategorySorterService $categorySorterService,
        CategoryRepository $categoryRepository,
        VolumeParserService $volumeParserService,
        ProductCodeParserService $productCodeParserService,
        AfterbuyAccountRepository $afterbuyAccountRepository
    ) {
        $this->afterbuySupplierFacade = $afterbuySupplierFacade;
        $this->orderRepository = $orderRepository;
        $this->categorySorterService = $categorySorterService;
        $this->categoryRepository = $categoryRepository;
        $this->volumeParserService = $volumeParserService;
        $this->productCodeParserService = $productCodeParserService;
        $this->afterbuyAccountRepository = $afterbuyAccountRepository;
    }

    private function importAllFromAfterbuyAccount(AfterbuyAccount $afterbuyAccount): OrderCollection
    {
        $orders = $this->afterbuySupplierFacade->getSoldItems($afterbuyAccount);

        $categories = $this->categoryRepository->findAll();
        foreach ($orders->getAllSoldItems() as $soldItem) {
            $category = $this->categorySorterService->getAppropriateCategoryForSoldItem($soldItem, $categories);
            $soldItem->setCategory($category);

            $volume = $this->volumeParserService->parseVolume($soldItem);
            $soldItem->setVolume($volume);

            $productCode = $this->productCodeParserService->parseProductCode($soldItem);
            $soldItem->setProductCode($productCode);
        }

        foreach ($orders as $order) {
            $order->setAfterbuyAccount($afterbuyAccount);
        }

        return $orders;
    }

    public function importAllAndSave(): void
    {
        $orders = new OrderCollection();

        $afterbuyAccounts = $this->afterbuyAccountRepository->findAll();
        foreach ($afterbuyAccounts as $afterbuyAccount) {
            $ordersFromAccount = $this->importAllFromAfterbuyAccount($afterbuyAccount);
            $orders->addCollection($ordersFromAccount);
        }

        foreach ($orders as $order) {
            $this->orderRepository->save($order);
        }
    }
}