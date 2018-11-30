<?php

namespace Identity\Domain\Model\User\Command\Handler;

use Identity\Domain\Model\User\Command\AsyncSmsNotificationCommand;

class AsyncSmsNotificationHandler
{
    public function __invoke(AsyncSmsNotificationCommand $message)
    {
        echo 'ASYNC-MESSAGE '.$message->getContent().PHP_EOL;

        return $message->getContent();
    }
}
