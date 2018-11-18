<?php

declare(strict_types=1);

namespace App\Command\User;

use Identity\Domain\Model\User\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserListCommand extends Command
{
    protected static $defaultName = 'user:list';

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

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

        $users = $this->userRepository->getAll();

        $table = new Table($output);
        foreach ($users as &$user) {
            $table->addRow([$user->userId(), $user->email(), $user->firstName()]);
        }

        $table->render();
    }
}
