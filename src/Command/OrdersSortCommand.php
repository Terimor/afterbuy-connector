<?php

namespace App\Command;

use App\Core\Repository\CategoryRepository;
use App\Core\Repository\SoldItemRepository;
use App\Core\Service\CategorySorterService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class OrdersSortCommand extends Command
{
    protected static $defaultName = 'orders:sort';

    private SoldItemRepository $soldItemRepository;

    private CategoryRepository $categoryRepository;

    private CategorySorterService $categorySorterService;

    public function __construct(SoldItemRepository $soldItemRepository, CategoryRepository $categoryRepository, CategorySorterService $categorySorterService)
    {
        $this->soldItemRepository = $soldItemRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categorySorterService = $categorySorterService;
        parent::__construct(self::$defaultName);
    }

    protected function configure(): void
    {
        $this->setDescription('Import orders from external storages');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $soldItemCollection = $this->soldItemRepository->findAllWithoutCategory();
        $categories = $this->categoryRepository->findAll();
        foreach ($soldItemCollection as $soldItem) {
            $category = $this->categorySorterService->getAppropriateCategoryForSoldItem($soldItem, $categories);
            $soldItem->setCategory($category);

            $this->soldItemRepository->save($soldItem);
        }

        return Command::SUCCESS;
    }
}