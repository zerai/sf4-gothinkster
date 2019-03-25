<?php

declare(strict_types=1);

namespace Member\Application\Service;

class FollowUserRequest
{
    /** @var string */
    private $userId;

    /** @var string */
    private $followingUserId;

    /**
     * FollowUserRequest constructor.
     *
     * @param string $userId
     * @param string $followingUserId
     */
    public function __construct(string $userId, string $followingUserId)
    {
        $this->userId = $userId;
        $this->followingUserId = $followingUserId;
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
    public function followingUserId(): string
    {
        return $this->followingUserId;
    }
}
