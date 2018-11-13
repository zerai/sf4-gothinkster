<?php

declare(strict_types=1);

namespace Identity\Domain\Model\Identity;

interface IdentityRepository
{
    /**
     * Saves given identity.
     *
     * @param Identity $identity Identity to save
     */
    public function add(Identity $identity): void;

    /**
     * @return IdentityId a unique, generated identity Id
     */
    public function getNextIdentityId(): IdentityId;

    /**
     * @return IdentityId a unique, generated identity Id
     */
    public function nextIdentity(): IdentityId;
}
