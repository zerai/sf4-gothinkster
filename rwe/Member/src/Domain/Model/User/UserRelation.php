<?php

declare(strict_types=1);

namespace Member\Domain\Model\User;

use Member\Domain\Model\User\Event\UserWasMarkedAsFollowed;
use Prooph\Common\Messaging\DomainEvent;
use SharedKernel\Domain\Entity;
use SharedKernel\Infrastructure\EventStore\Prooph\DomainEvent\DomainEventProducerTrait;

class UserRelation implements Entity
{
    use DomainEventProducerTrait;
    /** @var UserId */
    private $userId;

    /** @var array */
    private $following = [];

    /** @var array */
    private $followers = [];

    /**
     * UserRelation constructor.
     *
     * @param UserId $userId
     */
    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return UserId
     */
    public function userId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return array
     */
    public function following(): array
    {
        return $this->following;
    }

    /**
     * @return array
     */
    public function followers(): array
    {
        return $this->followers;
    }

    public function addFollowingUser(UserId $userId)
    {
        if ($this->canAddFollowingUser($userId)) {
            $this->following[] = $userId->toString();
            $this->recordThat(
                UserWasMarkedAsFollowed::with($this->userId->toString(), $userId->toString())
                //UserWasMarkedAsFollowed::with('xxxxxx', 'xxxxxx')
            );

            //var_dump($this->popRecordedEvents());
        }
    }

    private function canAddFollowingUser(UserId $userId): bool
    {
        if ($this->userId()->equals($userId)) {
            return false;
        }

        if (in_array($userId, $this->following())) {
            return false;
        }

        return true;
    }

    public function removeFollowingUser(UserId $userId)
    {
        foreach ($this->following as $k => $followingUser) {
            if ($followingUser == $userId) {
                unset($this->following[$k]);
                break;
            }
        }
    }

    public function sameIdentityAs(Entity $other): bool
    {
        return get_class($this) === get_class($other) && $this->userId->equals($other->userId);
    }

    protected function aggregateId(): string
    {
        // TODO: Implement aggregateId() method.
        return $this->userId->toString();
    }

    /*
     * Apply given event.
     */
//    protected function apply(DomainEvent $event): void
//    {
//        // TODO: Implement apply() method.
//    }
}
