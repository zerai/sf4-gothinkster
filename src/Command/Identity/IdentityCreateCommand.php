<?php

namespace App\Command\Identity;


use Identity\Domain\Model\Identity\Email;
use Identity\Domain\Model\Identity\HashPassword;
use Identity\Domain\Model\Identity\Identity;
use Identity\Domain\Model\Identity\IdentityId;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class IdentityCreateCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'identity:create';

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

        $identityService = $this->getContainer()->get('Identity\Application\IdentityService');


        $newIdentityId = $identityService->NewIdentity('pluto', 'password_paperino');

        $io->note(sprintf('New Identity with id: %s', $newIdentityId));
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
