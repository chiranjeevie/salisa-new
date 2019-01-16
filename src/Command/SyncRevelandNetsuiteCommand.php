<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\SyncService;
use Revel\Revel;

class SyncRevelandNetsuiteCommand extends Command
{

   /**
     * @var SyncHelper
     */
    private $syncHelper;

    public function __construct(SyncService $syncHelper)
    {
        $this->syncHelper = $syncHelper;
        parent::__construct();

    }

    protected function configure()
    {
        $this
            ->setName('sync:syncRevelToNetsuite')
            ->setDescription('sync Revel To Netsuite')
            ->addArgument('module', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('limit', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('module');

        $startTime = time();

        ini_set("memory_limit", "512M");

        //$this->initContainers();

        $this->syncHelper->executeBulk($output);

        $endTime = time() - $startTime;
        $totalSec = $endTime;

        echo "\n------------------------------------------------------------ \n";
        echo "Script execution time: {$totalSec} seconds \n";
        echo "------------------------------------------------------------ \n";

        $io->success($arg1.' Sync REVEL -> NETSUITE  completed successfully.');

    }
}
