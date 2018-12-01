<?php

declare(strict_types=1);

namespace Identity\Application\Service\User;

use Ddd\Application\Service\ApplicationService;
use Identity\Domain\Model\User\Email;
use Identity\Domain\Model\User\Exception\EmailAlreadyExistsException;
use Identity\Domain\Model\User\Exception\UserAlreadyExistsException;
use Identity\Domain\Model\User\User;
use Identity\Domain\Model\User\UserId;
use Identity\Domain\Model\User\UserRepository;
use Identity\Domain\Service\ChecksUniqueUsersEmailInterface;

class RegisterUserService implements ApplicationService
{
    /** @var UserRepository */
    private $userRepository;

    /** @var ChecksUniqueUsersEmailInterface */
    private $checksUniqueUsersEmail;

    public function __construct(UserRepository $userRepository, ChecksUniqueUsersEmailInterface $checksUniqueUsersEmail)
    {
        $this->userRepository = $userRepository;
        $this->checksUniqueUsersEmail = $checksUniqueUsersEmail;
    }

    /**
     * @param null $request
     *
     * @return mixed|string
     *
     * @throws EmailAlreadyExistsException
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

        if ($userId = ($this->checksUniqueUsersEmail)(Email::fromString($request->email()))) {
            throw new EmailAlreadyExistsException();
        }

        // modify first name
        $user = new User(UserId::fromString($request->userId()), $request->email());

        $this->userRepository->save($user);

        return $user->userId()->toString();
    }
}
