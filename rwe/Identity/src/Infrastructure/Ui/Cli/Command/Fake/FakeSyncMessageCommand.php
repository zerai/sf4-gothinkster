<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Ui\Cli\Command\Fake;

use Identity\Domain\Model\User\Command\SleepMessage;
use Identity\Domain\Model\User\Command\SmsNotificationCommand;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class FakeSyncMessageCommand extends Command
{
    protected static $defaultName = 'rwe:fake:sync-message';

    private $logger;

    private $commandBus;

    public function __construct(LoggerInterface $logger, MessageBusInterface $commandBus)
    {
        $this->logger = $logger;
        $this->commandBus = $commandBus;

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

        $result = $this->commandBus->dispatch(
            // this ok
            //new SleepMessage(15, 'Hello World')

            // this ok
            new SmsNotificationCommand('my sms message')
        );

        $io->note(sprintf('Notified message to: %s', $result));
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
