<?php


namespace App\Core\ApiFacade\Service;


use App\Core\Entity\Collection\CategoryCollection;
use App\Core\Entity\Collection\SoldItemCollection;
use App\Core\Entity\SoldItem;
use App\Core\Entity\Volume;
use App\Core\Repository\CategoryRepository;
use App\Core\Service\CategorySorterService;
use App\Core\Service\ProductCodeParserService;
use App\Core\Service\VolumeParserService;
use Symfony\Component\HttpKernel\KernelInterface;
use ZipArchive;

class ManualFileSorterService
{
    private const ZIP_FOLDER_PATH = '%s/var/temp/%s';

    private const GOODS_HEADERS = [
        self::TITLE => 'TITLE',
        self::QUANTITY => 'QUANTITY',
        self::CATEGORY => 'CATEGORY',
        self::VOLUME => 'VOLUME',
        self::TOTAL_VOLUME => 'TOTAL_VOLUME',
    ];

    private const TITLE = 0;
    private const QUANTITY = 1;
    private const CATEGORY = 2;
    private const VOLUME = 3;
    private const TOTAL_VOLUME = 4;

    private const CSV_DELIMITER = ';';

    private const VOLUME_FORMAT = '%f %s';

    private const NOT_PARSED = 'NOT_PARSED';
    private const UNSORTED = 'UNSORTED';

    private CategorySorterService $categorySorterService;

    private VolumeParserService $volumeParserService;

    private ProductCodeParserService $productCodeParserService;

    private CategoryRepository $categoryRepository;

    private KernelInterface $kernel;

    public function __construct(
        CategorySorterService $categorySorterService,
        VolumeParserService $volumeParserService,
        ProductCodeParserService $productCodeParserService,
        CategoryRepository $categoryRepository,
        KernelInterface $kernel
    ) {
        $this->categorySorterService = $categorySorterService;
        $this->volumeParserService = $volumeParserService;
        $this->productCodeParserService = $productCodeParserService;
        $this->categoryRepository = $categoryRepository;
        $this->kernel = $kernel;
    }

    public function sortAndGetZipPathname(string $inputPathname): string
    {
        $categories = $this->categoryRepository->findAll();
        $soldItems = $this->readItems($inputPathname, $categories);

        return $this->createZipResponse($soldItems, $categories);
    }

    private function readItems(string $inputPathname, CategoryCollection $categories): SoldItemCollection
    {
        $result = new SoldItemCollection();

        $handle = fopen($inputPathname, 'rwb+');

        fgetcsv($handle);//pass first line
        while (($data = fgetcsv($handle, 1000, self::CSV_DELIMITER)) !== false) {
            $description = $data[self::TITLE];
            $quantity = (int)$data[self::QUANTITY];

            $soldItem = new SoldItem();
            $soldItem->setTitle($description);
            $soldItem->setQuantity($quantity);

            $category = $this->categorySorterService->getAppropriateCategoryForSoldItem($soldItem, $categories);
            $soldItem->setCategory($category);

            $volume = $this->volumeParserService->parseVolume($soldItem);
            $soldItem->setVolume($volume);

            $productCode = $this->productCodeParserService->parseProductCode($soldItem);
            $soldItem->setProductCode($productCode);

            $result->add($soldItem);
        }

        return $result;
    }

    private function createZipResponse(SoldItemCollection $soldItems, CategoryCollection $categories): string
    {
        $zip = new ZipArchive();
        $zipPathname = $this->generateZipPathname();

        $zip->open($zipPathname, ZipArchive::CREATE);

        foreach ($categories as $category) {
            $categorySoldItems = $soldItems->filterByCategory($category);
            $csv = $this->generateCsv($categorySoldItems);
            $zip->addFromString($category->getName().'.csv', $csv);
        }

        $unsortedSoldItems = $soldItems->filterByNullCategory();
        $csv = $this->generateCsv($unsortedSoldItems);

        $zip->addFromString(self::UNSORTED.'.csv', $csv);

        $zip->close();

        return $zipPathname;
    }

    private function generateCsv(SoldItemCollection $soldItems): string
    {
        $stream = fopen('php://memory', 'rwb+');

        fputcsv($stream, self::GOODS_HEADERS, self::CSV_DELIMITER);
        foreach ($soldItems as $soldItem) {
            $soldItemArray = $this->buildCsvArrayFromSoldItem($soldItem);
            fputcsv($stream, $soldItemArray, self::CSV_DELIMITER);
        }
        $totalVolumeAmount = $soldItems->calculateTotalVolumeAmount();
        fputcsv($stream, $this->buildTotalCsvArray($totalVolumeAmount), self::CSV_DELIMITER);
        rewind($stream);

        return iconv('utf-8', 'CP1252', rtrim(stream_get_contents($stream)));
    }

    private function buildCsvArrayFromSoldItem(SoldItem $soldItem): array
    {
        return [
            self::TITLE => $soldItem->getTitle(),
            self::QUANTITY => $soldItem->getQuantity(),
            self::CATEGORY => $soldItem->getCategory() ? $soldItem->getCategory()->getName() : self::UNSORTED,
            self::VOLUME => $this->buildVolumeString($soldItem->getVolume()),
            self::TOTAL_VOLUME => $soldItem->getVolume() ? ($soldItem->getVolume()->getAmount() * $soldItem->getQuantity()) : self::NOT_PARSED,
        ];
    }

    private function buildTotalCsvArray(float $total): array
    {
        return [
            self::TITLE => null,
            self::QUANTITY => null,
            self::CATEGORY => null,
            self::VOLUME => null,
            self::TOTAL_VOLUME => $total,
        ];
    }

    private function buildVolumeString(?Volume $volume): string
    {
        if ($volume) {
            return sprintf(self::VOLUME_FORMAT, $volume->getAmount(), $volume->getUnitCode()->getValue());
        }

        return self::NOT_PARSED;
    }

    private function generateZipPathname(): string
    {
        return sprintf(self::ZIP_FOLDER_PATH, $this->kernel->getProjectDir(), uniqid().'.zip');
    }
}