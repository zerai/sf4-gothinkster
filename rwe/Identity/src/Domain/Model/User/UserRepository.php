<?php

declare(strict_types=1);

namespace Identity\Domain\Model\User;

interface UserRepository
{
    /**
     * Saves given user.
     *
     * @param User $user User to save
     */
    public function add(User $user): void;

    /**
     * List all users.
     *
     * @return User[] List of all User
     */
    public function getAll(): array;

    /**
     * @param string $email
     *
     * @return User|null
     */
    public function ofEmail(string $email): ?User;

    /**
     * @return UserId a unique, generated user Id
     */
    public function nextIdentity(): UserId;
}
