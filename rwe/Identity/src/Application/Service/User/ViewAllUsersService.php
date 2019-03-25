<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

class ViewAllUsersService extends UserService
{
    /**
     * @param null $request
     *
     * @return array|\Identity\Domain\Model\User\User[]|mixed
     */
    public function execute($request = null)
    {
        // TODO: Implement execute() method.

        return $this->userRepository->getAll();
    }
}
