<?php

declare(strict_types=1);

namespace Identity\Domain\Model\Identity;

final class IdentityId
{
    private $uuid;

    /**
     * @return IdentityId
     *
     * @throws \Exception
     */
    public static function generate(): IdentityId
    {
        return new self(\Ramsey\Uuid\Uuid::uuid4());
    }

    /**
     * @param string $identityId
     *
     * @return IdentityId
     */
    public static function fromString(string $identityId): IdentityId
    {
        return new self(\Ramsey\Uuid\Uuid::fromString($identityId));
    }

    /**
     * IdentityId constructor.
     *
     * @param \Ramsey\Uuid\UuidInterface $identityId
     */
    private function __construct(\Ramsey\Uuid\UuidInterface $identityId)
    {
        $this->uuid = $identityId;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->uuid->toString();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    /**
     * @param IdentityId $other
     *
     * @return bool
     */
    public function equals(IdentityId $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}
