<?php

declare(strict_types=1);

namespace App\Command\Identity;

use Identity\Domain\Model\Identity\IdentityRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class IdentityListCommand extends Command
{
    protected static $defaultName = 'identity:list';

    private $logger;

    private $identityRepository;

    public function __construct(LoggerInterface $logger, IdentityRepository $identityRepository)
    {
        $this->logger = $logger;
        $this->identityRepository = $identityRepository;

        // you *must* call the parent constructor
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('List all Identities.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $identities = $this->identityRepository->getAll();

        $table = new Table($output);
        foreach ($identities as &$identity) {
            //$value = $value * 2;
            $table->addRow([$identity->identityId()->toString(), $identity->email()->toString()]);
        }

        $table->render();
    }
}
