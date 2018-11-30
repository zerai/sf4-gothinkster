<?php

declare(strict_types=1);

namespace Identity\Domain\Model\User\Process;

use Identity\Domain\Model\User\Command\SyncSmsNotificationCommand;
use Identity\Domain\Model\User\Event\SyncSmsNotificationWasSent;
use Symfony\Component\Messenger\MessageBusInterface;

class SyncReactOnEvent
{
    /** @var MessageBusInterface */
    private $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(SyncSmsNotificationWasSent $event): void
    {
        $this->commandBus->dispatch(
            new SyncSmsNotificationCommand('command react on event')
        );
    }
}
