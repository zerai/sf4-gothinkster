<?php

declare(strict_types=1);

namespace Identity\Domain\Model\User;

final class User
{
    /** @var UserId */
    private $userId;

    /** @var string */
    private $email;

    /** @var FirstName */
    private $firstName;

    /** @var LastName */
    private $lastName;

    public function __construct(UserId $userId, string $email)
    {
        $this->userId = $userId;
        $this->email = $email;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return FirstName
     */
    public function firstName(): ?FirstName
    {
        return $this->firstName;
    }

    /**
     * @return LastName
     */
    public function lastName(): LastName
    {
        return $this->lastName;
    }

    /**
     * @param FirstName $firstName
     */
    public function changeFirstName(FirstName $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @param LastName $lastName
     */
    public function changeLastName(LastName $lastName): void
    {
        $this->lastName = $lastName;
    }
}
