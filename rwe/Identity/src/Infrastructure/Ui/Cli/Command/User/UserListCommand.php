<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Ui\Cli\Command\User;

use Identity\Application\Service\User\ViewAllUsersService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserListCommand extends Command
{
    protected static $defaultName = 'rwe:user:list';

    private $viewAllUsersService;

    public function __construct(ViewAllUsersService $viewAllUsersService)
    {
        $this->viewAllUsersService = $viewAllUsersService;

        // you *must* call the parent constructor
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('List all Users.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $users = $this->viewAllUsersService->execute(); //$this->userRepository->getAll();

        $table = new Table($output);
        $table->setHeaders([
            [new TableCell('User List', ['colspan' => 4])],
            ['Identifier', 'Email', 'FirstName', 'LastName'],
        ]);
        //TODO: add LastName
        foreach ($users as &$user) {
            $table->addRow([$user->userId(), $user->email(), $user->firstName(), '']);
        }

        $table->render();
    }
}
