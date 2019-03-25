<?php

declare(strict_types=1);

namespace Identity\Domain\Model\User;

final class UserId
{
    private $uuid;

    public static function generate(): UserId
    {
        return new self(\Ramsey\Uuid\Uuid::uuid4());
    }

    public static function fromString(string $userId): UserId
    {
        return new self(\Ramsey\Uuid\Uuid::fromString($userId));
    }

    private function __construct(\Ramsey\Uuid\UuidInterface $userId)
    {
        $this->uuid = $userId;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public function equals(UserId $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}
