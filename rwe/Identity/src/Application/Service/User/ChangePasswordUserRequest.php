<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

class ChangePasswordUserRequest
{
    /** @var string */
    private $userId;

    /** @var string */
    private $plainPassword;

    /**
     * ChangePasswordUserRequest constructor.
     *
     * @param string $userId
     * @param string $plainPassword
     */
    public function __construct(string $userId, string $plainPassword)
    {
        $this->userId = $userId;
        $this->plainPassword = $plainPassword;
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
    public function plainPassword(): string
    {
        return $this->plainPassword;
    }
}
