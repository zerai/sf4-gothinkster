<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 27/11/18
 * Time: 11.06.
 */

namespace Identity\Domain\Model\User\Command;

class SleepMessage
{
    private $seconds;
    private $output;

    public function __construct(int $seconds, string $output)
    {
        $this->seconds = $seconds;
        $this->output = $output;
    }

    public function getSeconds()
    {
        return $this->seconds;
    }

    public function getOutput()
    {
        return $this->output;
    }
}
