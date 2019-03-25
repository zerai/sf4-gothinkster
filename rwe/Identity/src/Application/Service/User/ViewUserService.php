<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

use Identity\Domain\Model\User\Exception\UserDoesNotExistException;
use Identity\Domain\Model\User\UserId;

class ViewUserService extends UserService
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
        /** @var ViewUserRequest $request */
        if (!$user = $this->userRepository->ofId(UserId::fromString($request->userId()))) {
            throw new UserDoesNotExistException();
        }

        return $user;
    }
}
