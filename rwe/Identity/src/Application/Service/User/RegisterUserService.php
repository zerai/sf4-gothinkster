<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

use Ddd\Application\Service\ApplicationService;
use Identity\Domain\Model\User\Exception\UserAlreadyExistsException;
use Identity\Domain\Model\User\User;
use Identity\Domain\Model\User\UserId;
use Identity\Domain\Model\User\UserRepository;

class RegisterUserService implements ApplicationService
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * RegisterUserService constructor.
     *
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterUserRequest $request
     *
     * @return mixed
     *
     * @throws UserAlreadyExistsException
     */
    public function execute($request = null)
    {
        // TODO: Implement execute() method.
//        var_dump($request);
        //TODO: usare mail non Id
        if ($user = $this->userRepository->ofId(UserId::fromString($request->userId()))) {
            throw new UserAlreadyExistsException();
        }
        // modify first name
        $user = new User(UserId::fromString($request->userId()), $request->email());

        $this->userRepository->save($user);

        return $user->userId()->toString();
    }
}
