<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

use Identity\Domain\Model\User\Exception\UserDoesNotExistException;
use Identity\Domain\Model\User\UserId;

class ChangePasswordUserService extends UserService
{
    /**
     * @param null $request
     *
     * @return mixed|void
     *
     * @throws UserDoesNotExistException
     */
    public function execute($request = null)
    {
        $user = $this->userRepository->ofId(UserId::fromString($request->userId()));

        if (!$user) {
            throw new UserDoesNotExistException();
        }

        //TODO:
    }
}
