<?php

namespace App\Command;

use App\Core\Manager\OrdersImportManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class OrdersImportCommand extends Command
{
    protected static $defaultName = 'orders:import';

    private OrdersImportManager $ordersImportManager;

    public function __construct(OrdersImportManager $ordersImportManager)
    {
        $this->ordersImportManager = $ordersImportManager;
        parent::__construct(self::$defaultName);
    }

    protected function configure(): void
    {
        $this->setDescription('Import orders from external storages');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->ordersImportManager->importAll();

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
