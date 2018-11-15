<?php

declare(strict_types=1);

namespace Identity\Domain\Model\User;

final class FirstName
{
    private $firstName;

    public function __construct(string $firstName)
    {
        if (strlen($firstName) < 2) {
            throw new \InvalidArgumentException('first name too short');
        }

        $this->firstName = $firstName;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function withFirstName(string $firstName): FirstName
    {
        return new self($firstName);
    }

    public static function fromString(string $firstName): FirstName
    {
        return new self($firstName);
    }

    public function toString(): string
    {
        return $this->firstName;
    }

    public function __toString(): string
    {
        return $this->firstName;
    }

    public function equals(FirstName $firstName): bool
    {
        return $this->firstName === $firstName->firstName;
    }
}
