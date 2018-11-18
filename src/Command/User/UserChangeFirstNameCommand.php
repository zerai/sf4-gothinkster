<?php

declare(strict_types=1);

namespace App\Command\User;

use Identity\Application\UserService;
use Identity\Domain\Model\User\Exception\UserDoesNotExistException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserChangeFirstNameCommand extends Command
{
    protected static $defaultName = 'user:change:first-name';

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
            ->setDescription('Change first name of user')
            ->addArgument('userId', InputArgument::OPTIONAL, 'user identifier.')
            ->addArgument('firstName', InputArgument::OPTIONAL, 'user first name.')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $userIdArg = $input->getArgument('userId');
        $firstNameArg = $input->getArgument('firstName');

        if ($userIdArg) {
            $io->note(sprintf('You passed an user_id: %s', $userIdArg));
        }

        if ($firstNameArg) {
            $io->note(sprintf('You passed an firs_name: %s', $firstNameArg));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        try {
            $this->userService->changeFirstName($userIdArg, $firstNameArg);
        } catch (UserDoesNotExistException $e) {
            $io->error(sprintf('User with id: %s not found.', $userIdArg));
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}