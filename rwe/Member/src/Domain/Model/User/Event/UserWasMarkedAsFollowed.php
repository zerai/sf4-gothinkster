<?php

// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace Member\Domain\Model\User\Event;

final class UserWasMarkedAsFollowed extends \Prooph\Common\Messaging\DomainEvent
{
    use \Prooph\Common\Messaging\PayloadTrait;

    public const MESSAGE_NAME = 'Member\Domain\Model\User\Event\UserWasMarkedAsFollowed';

    protected $messageName = self::MESSAGE_NAME;

    private $userId;

    private $followedUser;

    public function userId(): string
    {
        if (null === $this->userId) {
            $this->userId = $this->payload['userId'];
        }

        return $this->userId;
    }

    public function followedUser(): string
    {
        if (null === $this->followedUser) {
            $this->followedUser = $this->payload['followedUser'];
        }

        return $this->followedUser;
    }

    public static function with(string $userId, string $followedUser): userWasMarkedAsFollowed
    {
        return new self([
            'userId' => $userId,
            'followedUser' => $followedUser,
        ]);
    }

    protected function setPayload(array $payload): void
    {
        if (!isset($payload['userId']) || !\is_string($payload['userId'])) {
            throw new \InvalidArgumentException("Key 'userId' is missing in payload or is not a string");
        }

        if (!isset($payload['followedUser']) || !\is_string($payload['followedUser'])) {
            throw new \InvalidArgumentException("Key 'followedUser' is missing in payload or is not a string");
        }

        $this->payload = $payload;
    }
}
