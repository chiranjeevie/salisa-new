<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SyncNetsuiteAndRevelCommand extends Command
{
    protected static $defaultName = 'syncNetsuiteAndRevel';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('module', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('limit', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('module');

        if ($arg1) {
            $io->note(sprintf('we are processing the module: %s', $arg1));
        }

        if ($input->getOption('limit')) {
            $io->note(sprintf('You passed an argument: %s', $input->getOption('limit')));
        }

        $io->success($arg1.' Sync (NETSUITE -> REVEL)  completed successfully.');
    }
}
