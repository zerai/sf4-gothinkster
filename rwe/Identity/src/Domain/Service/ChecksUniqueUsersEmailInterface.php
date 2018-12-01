<?php

declare(strict_types=1);

namespace Identity\Domain\Service;

use Identity\Domain\Model\User\Email;
use Identity\Domain\Model\User\UserId;

interface ChecksUniqueUsersEmailInterface
{
    public function __invoke(Email $email): ?UserId;
}
