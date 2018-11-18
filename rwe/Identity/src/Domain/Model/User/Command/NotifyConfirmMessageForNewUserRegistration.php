<?php

declare(strict_types=1);

namespace Identity\Domain\Model\User\Command;

class NotifyConfirmMessageForNewUserRegistration
{
    private $userEmail;

    /**
     * NotifyConfirmMessageForNewUserRegistration constructor.
     *
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->userEmail = $email;
    }

    /**
     * @return string
     */
    public function getUserEmail(): string
    {
        return $this->userEmail;
    }
}
