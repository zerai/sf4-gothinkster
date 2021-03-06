<?php

declare(strict_types=1);

namespace Identity\Domain\Model\Identity;

final class Email
{
    private $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function withEmail(string $email): Email
    {
        return new self($email);
    }

    public static function fromString(string $email): Email
    {
        return new self($email);
    }

    public function toString(): string
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    public function equals(Email $email): bool
    {
        return $this->email === $email->email;
    }
}
