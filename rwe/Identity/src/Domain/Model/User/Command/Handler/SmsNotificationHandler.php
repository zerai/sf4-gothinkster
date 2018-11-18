<?php

namespace Identity\Domain\Model\User\Command\Handler;

use Identity\Domain\Model\User\Command\SmsNotificationCommand;

class SmsNotificationHandler
{
    public function __invoke(SmsNotificationCommand $message)
    {
        return $message->getContent();
    }
}
