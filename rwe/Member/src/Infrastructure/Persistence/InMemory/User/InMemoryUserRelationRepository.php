<?php

namespace Member\Infrastructure\Persistence\InMemory\User;

use Member\Domain\Model\User\UserId;
use Member\Domain\Model\User\UserRelation;
use Member\Domain\Model\User\UserRelationRepository;

class InMemoryUserRelationRepository implements UserRelationRepository
{
    /**
     * @var UserRelation[]
     */
    private $userRelations = [];

    public function save(UserRelation $userRelation): void
    {
        $this->userRelations[$userRelation->userId()->toString()] = $userRelation;
    }

    public function ofId(UserId $userId)
    {
        foreach ($this->userRelations as $userRelation) {
            if ($userRelation->userId()->equals($userId)) {
                return $userRelation;
            }
        }

        return;
    }
}
