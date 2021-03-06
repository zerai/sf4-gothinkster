<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Ui\Cli\Command\Fake;

use Identity\Domain\Model\User\Event\FakeWasRegister;
use Identity\Domain\Model\User\Event\SmsNotificationWasSent;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class FakeAsyncEventMessageCommand extends Command
{
    protected static $defaultName = 'rwe:fake:async-event-message';

    private $logger;

    private $eventBus;

    public function __construct(LoggerInterface $logger, MessageBusInterface $eventBus)
    {
        $this->logger = $logger;
        $this->eventBus = $eventBus;

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

        $result = $this->eventBus->dispatch(
            new SmsNotificationWasSent('prova')
            //FakeWasRegister::with('zero', 'zero@example.it')
        );

        $io->note(sprintf('Notified message to: %s', $result));
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
