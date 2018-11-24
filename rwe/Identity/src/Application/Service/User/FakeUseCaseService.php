<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

use Ddd\Application\Service\ApplicationService;
use Identity\Domain\Model\User\Exception\UserDoesNotExistException;
use Identity\Domain\Model\User\FirstName;
use Identity\Domain\Model\User\UserId;
use Identity\Domain\Model\User\UserRepository;

class FakeUseCaseService implements ApplicationService
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * FakeUseCaseService constructor.
     *
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param FakeUseCaseRequest $request
     *
     * @return mixed
     *
     * @throws UserDoesNotExistException
     */
    public function execute($request = null)
    {
        // TODO: Implement execute() method.

        if (!$user = $this->userRepository->ofId(UserId::fromString($request->userId()))) {
            throw new UserDoesNotExistException();
        }
        // modify first name
        $user->changeFirstName(FirstName::fromString($request->firstName()));

        $this->userRepository->save($user);

        return $user->userId()->toString();
    }
}
