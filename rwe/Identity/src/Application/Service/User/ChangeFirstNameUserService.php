<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

use Identity\Domain\Model\User\Exception\UserDoesNotExistException;
use Identity\Domain\Model\User\FirstName;
use Identity\Domain\Model\User\UserId;

class ChangeFirstNameUserService extends UserService
{
    /**
     * @param null $request
     *
     * @return \Identity\Domain\Model\User\User|mixed
     *
     * @throws UserDoesNotExistException
     */
    public function execute($request = null)
    {
        $user = $this->userRepository->ofId(UserId::fromString($request->userId()));

        if (!$user) {
            throw new UserDoesNotExistException();
        }

        $user->changeFirstName(FirstName::fromString($request->firstName()));

        $this->userRepository->save($user);

        return $user;
    }
}
