<?php

declare(strict_types=1);

namespace Identity\Domain\Model\User\Command\Handler;

use Identity\Domain\Model\User\Command\NotifyConfirmMessageForNewUserRegistration;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class NotifyConfirmMessageForNewUserRegistrationHandler implements MessageHandlerInterface
{
    public function __invoke(NotifyConfirmMessageForNewUserRegistration $command)
    {
        // TODO: Implement __invoke() method.

        return 'notifica conferma registrazione infiata a :'.$command->getUserEmail();
    }
}
