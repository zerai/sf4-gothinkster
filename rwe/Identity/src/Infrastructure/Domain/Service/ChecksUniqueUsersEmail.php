<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Domain\Service;

use Identity\Domain\Model\User\Email;
use Identity\Domain\Model\User\UserId;
use Identity\Domain\Model\User\UserRepository;
use Identity\Domain\Service\ChecksUniqueUsersEmailInterface;

class ChecksUniqueUsersEmail implements ChecksUniqueUsersEmailInterface
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(Email $email): ?UserId
    {
        if ($user = $this->userRepository->findOneByEmail($email)) {
            return $user->userId();
        }

        return null;
    }
}
