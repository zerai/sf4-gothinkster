<?php

namespace Identity\Domain\Model\User\Event;

class SyncSmsNotificationWasSent
{
    private $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
