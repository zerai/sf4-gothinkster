<?php

declare(strict_types=1);

namespace Member\Domain\Model\User;

interface UserRelationRepository
{
    public function save(UserRelation $userRelation): void;

    public function ofId(UserId $userId);
}
