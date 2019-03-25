<?php

declare(strict_types=1);

namespace Identity\Domain\Model\User\Process;

use Identity\Domain\Model\User\Command\AsyncSmsNotificationCommand;
use Identity\Domain\Model\User\Event\AsyncSmsNotificationWasSent;
use Symfony\Component\Messenger\MessageBusInterface;

class AsyncReactOnEvent
{
    /** @var MessageBusInterface */
    private $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(AsyncSmsNotificationWasSent $event): void
    {
        $this->commandBus->dispatch(
            new AsyncSmsNotificationCommand('command react on async event')
        );
    }
}
