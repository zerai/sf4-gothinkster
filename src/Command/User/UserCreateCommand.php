<?php

declare(strict_types=1);

namespace App\Command\User;

use Identity\Application\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserCreateCommand extends Command
{
    protected static $defaultName = 'user:create';

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        // you *must* call the parent constructor
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        //$identityService = $this->getContainer()->get('Identity\Application\IdentityService');

        echo 'start';
        $newUserId = $this->userService->RegisterUser('fra@example.it');

        $io->note(sprintf('New Identity with id: %s', $newUserId));
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
