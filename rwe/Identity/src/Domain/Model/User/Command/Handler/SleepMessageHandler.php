<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 27/11/18
 * Time: 11.08.
 */

namespace Identity\Domain\Model\User\Command\Handler;

use Identity\Domain\Model\User\Command\SleepMessage;

class SleepMessageHandler
{
    public function __invoke(SleepMessage $sleepMessage)
    {
        $seconds = $sleepMessage->getSeconds();
        $output = $sleepMessage->getOutput();

        // Simulate a long running process.
        sleep($seconds);
        echo $output.PHP_EOL;
    }
}
