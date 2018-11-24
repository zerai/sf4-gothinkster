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
     * @param $userId
     * @param $plainPassword
     */
    public function __construct($userId, $plainPassword)
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
