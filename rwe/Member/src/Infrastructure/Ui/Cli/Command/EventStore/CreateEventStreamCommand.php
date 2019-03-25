<?php

declare(strict_types=1);

namespace Member\Infrastructure\Ui\Cli\Command\EventStore;

use Prooph\EventStore\EventStore;
use Prooph\EventStore\Stream;
use Prooph\EventStore\StreamName;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateEventStreamCommand extends ContainerAwareCommand
{
    private $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
        // you *must* call the parent constructor
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('rwe:event-stream-member:create')
            ->setDescription('Create member event_stream.')
            ->setHelp('This command creates the event_stream');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->eventStore->create(new Stream(new StreamName('member-event_stream'), new \ArrayIterator([])));

        $output->writeln('<info>Event stream was created successfully.</info>');
    }
}
