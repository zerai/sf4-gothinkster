<?php

namespace Identity\Domain\Model\User\Command\Handler;

use Identity\Domain\Model\User\Command\SyncSmsNotificationCommand;

class SyncSmsNotificationHandler
{
    public function __invoke(SyncSmsNotificationCommand $message)
    {
        echo 'SYNC-MESSAGE '.$message->getContent().PHP_EOL;

        return $message->getContent();
    }
}
