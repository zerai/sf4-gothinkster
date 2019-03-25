<?php

declare(strict_types=1);

namespace Member\Application\Service;

class UnfollowUserRequest
{
    /** @var string */
    private $userId;

    /** @var string */
    private $unfollowingUserId;

    /**
     * UnfollowUserRequest constructor.
     *
     * @param string $userId
     * @param string $unfollowingUserId
     */
    public function __construct(string $userId, string $unfollowingUserId)
    {
        $this->userId = $userId;
        $this->unfollowingUserId = $unfollowingUserId;
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
    public function unfollowingUserId(): string
    {
        return $this->unfollowingUserId;
    }
}
