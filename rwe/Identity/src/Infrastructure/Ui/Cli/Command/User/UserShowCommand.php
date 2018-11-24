<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Ui\Cli\Command\User;

use Identity\Application\Service\User\ViewUserRequest;
use Identity\Application\Service\User\ViewUserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserShowCommand extends Command
{
    protected static $defaultName = 'rwe:user:show';

    private $viewUserService;

    public function __construct(ViewUserService $viewUserService)
    {
        $this->viewUserService = $viewUserService;

        // you *must* call the parent constructor
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Show a User.')
            ->addArgument('user_id', InputArgument::REQUIRED, 'user identifier.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $user_id = $input->getArgument('user_id');

        $user = $this->viewUserService->execute(
            new ViewUserRequest($user_id)
        );

        $table = new Table($output);

        $table->addRow([$user->userId(), $user->email(), $user->firstName()]);

        $table->render();
    }
}
