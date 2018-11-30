<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Ui\Cli\Command\Fake;

use Identity\Domain\Model\User\Event\AsyncSmsNotificationWasSent;
use Identity\Infrastructure\Ui\Cli\Command\Fake\Event\QuickStartSucceeded;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\StreamName;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FakeEventStoreCommand extends Command
{
    protected static $defaultName = 'rwe:fake:event-store';

    private $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;

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

        $events[] = QuickStartSucceeded::withSuccessMessage('fake test');
        //$events[]= new AsyncSmsNotificationWasSent("From eventStore my async sms notify EVENT");

        $this->eventStore->appendTo(
            new StreamName('event_stream'),
            new \ArrayIterator($events)
        );

        //$io->note(sprintf('Notified message to: %s', $result));
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
