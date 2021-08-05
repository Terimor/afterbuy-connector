<?php


namespace App\Core\ApiFacade;


use App\Api\Entity\Common\Collection\ApiSoldItemCollection;
use App\Api\Entity\Response\ApiSoldItemsResponse;
use App\Core\ApiFacade\Bridge\Response\SoldItemResponseBridge;
use App\Core\ApiFacade\Service\ManualFileSorterService;
use App\Core\Repository\SoldItemRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SoldItemsFacade
{
    private SoldItemRepository $soldItemRepository;

    private SoldItemResponseBridge $soldItemResponseBridge;

    private ManualFileSorterService $manualFileSorterService;

    public function __construct(
        SoldItemRepository $soldItemRepository,
        SoldItemResponseBridge $soldItemResponseBridge,
        ManualFileSorterService $manualFileSorterService
    ) {
        $this->soldItemRepository = $soldItemRepository;
        $this->soldItemResponseBridge = $soldItemResponseBridge;
        $this->manualFileSorterService = $manualFileSorterService;
    }

    public function getAll(): ApiSoldItemsResponse
    {
        $soldItems = $this->soldItemRepository->findAll();

        $apiSoldItems = new ApiSoldItemCollection();
        foreach ($soldItems as $soldItem) {
            $apiSoldItem = $this->soldItemResponseBridge->build($soldItem);
            $apiSoldItems->add($apiSoldItem);
        }

        return new ApiSoldItemsResponse($apiSoldItems);
    }

    public function manualSort(UploadedFile $file): string
    {
        return $this->manualFileSorterService->sortAndGetZipPathname($file->getPathname());
    }
}