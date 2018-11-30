<?php

declare(strict_types=1);

namespace Identity\Domain\Model\User\Process;

use Identity\Domain\Model\User\Command\AsyncSmsNotificationCommand;
use Identity\Infrastructure\Ui\Cli\Command\Fake\Event\QuickStartSucceeded;
use Symfony\Component\Messenger\MessageBusInterface;

class AsyncReactOnProophEvent
{
    /** @var MessageBusInterface */
    private $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(QuickStartSucceeded $event): void
    {
        $this->commandBus->dispatch(
            new AsyncSmsNotificationCommand('command react on async Prooph event :'.$event->getText())
        );

        //echo 'prooph react' . $event->getText() . PHP_EOL;
    }
}
