<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

class RegisterUserRequest
{
    private $userId;

    private $email;

    public function __construct($userId, $email)
    {
        $this->userId = $userId;
        $this->email = $email;
    }

    public function userId()
    {
        return $this->userId;
    }

    public function email()
    {
        return $this->email;
    }
}
