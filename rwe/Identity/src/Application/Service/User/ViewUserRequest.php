<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

class ViewUserRequest
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function userId()
    {
        return $this->userId;
    }
}
