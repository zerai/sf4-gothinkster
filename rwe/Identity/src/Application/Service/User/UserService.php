<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

use Ddd\Application\Service\ApplicationService;
use Identity\Domain\Model\User\Exception\UserDoesNotExistException;
use Identity\Domain\Model\User\UserId;
use Identity\Domain\Model\User\UserRepository;

abstract class UserService implements ApplicationService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $userId
     *
     * @return \Identity\Domain\Model\User\User
     *
     * @throws UserDoesNotExistException
     */
    protected function findUserOrFail($userId)
    {
        $user = $this->userRepository->ofId(UserId::fromString($userId));
        if (null === $user) {
            throw new UserDoesNotExistException();
        }

        return $user;
    }
}
