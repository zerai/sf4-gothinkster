<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

class ChangeFirstNameUserRequest
{
    /** @var string */
    private $userId;

    /** @var string */
    private $firstName;

    /**
     * ChangePasswordUserRequest constructor.
     *
     * @param string $userId
     * @param string $firstName
     */
    public function __construct(string $userId, string $firstName)
    {
        $this->userId = $userId;
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function userId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function firstName(): string
    {
        return $this->firstName;
    }
}
