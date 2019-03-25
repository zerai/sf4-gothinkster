<?php

declare(strict_types=1);

namespace Identity\Domain\Model\Identity;

final class Identity
{
    private $identityId;
    private $email;
    private $hashPassword;

    public function __construct(IdentityId $identityId, Email $email, HashPassword $hashPassword)
    {
        $this->identityId = $identityId;
        $this->email = $email;
        $this->hashPassword = $hashPassword;
    }

    public function identityId(): IdentityId
    {
        return $this->identityId;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function hashPassword(): HashPassword
    {
        return $this->hashPassword;
    }

    public function assignNewHashPassword(HashPassword $hashPassword): void
    {
        $this->hashPassword = $hashPassword;
    }

    public function sameIdentityAs(Identity $other): bool
    {
        return $this->identityId()->equals($other->identityId());
    }
}
