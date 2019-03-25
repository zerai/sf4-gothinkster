<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

class FakeUseCaseRequest
{
    private $userId;

    private $firstName;

    public function __construct($userId, $firstName)
    {
        $this->userId = $userId;
        $this->firstName = $firstName;
    }

    public function firstName()
    {
        return $this->firstName;
    }

    public function userId()
    {
        return $this->userId;
    }
}
