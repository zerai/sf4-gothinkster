<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Ui\Cli\Command\User;

use Identity\Application\Service\User\RegisterUserRequest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserCreateCommand extends Command
{
    protected static $defaultName = 'rwe:user:create';

    private $txUserService;

    public function __construct($applicationService)
    {
        $this->txUserService = $applicationService;

        // you *must* call the parent constructor
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Register a new User')
            ->addArgument('user_id', InputArgument::REQUIRED, 'User identifier')
            ->addArgument('email', InputArgument::REQUIRED, 'Email address')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $user_id = $input->getArgument('user_id');

        $email = $input->getArgument('email');

        if ($input->getOption('option1')) {
            // ...
        }

        $newUserId = $this->txUserService->execute(
            new RegisterUserRequest($user_id, $email)
        );

        $io->success(sprintf('New User with id: %s', $newUserId));
    }
}
