<?php

declare(strict_types=1);

namespace Identity\Application;

use Identity\Domain\Model\User\Exception\UserDoesNotExistException;
use Identity\Domain\Model\User\FirstName;
use Identity\Domain\Model\User\User;
use Identity\Domain\Model\User\UserId;
use Identity\Domain\Model\User\UserRepository;
use SharedKernel\Application\TransactionManager\TransactionManager;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var TransactionManager
     */
    private $transactionManager;

    public function __construct(
        UserRepository $userRepository,
        TransactionManager $transactionManager
    ) {
        $this->userRepository = $userRepository;
        $this->transactionManager = $transactionManager;
    }

    public function RegisterUser(string $email): string
    {
        $userId = $this->userRepository->nextIdentity();

        $user = new User($userId, $email);

        $this->transactionManager->beginTransaction();
        try {
            $this->userRepository->add($user);
            $this->transactionManager->commit();

            return $userId->toString();
        } catch (\Exception $ex) {
            $this->transactionManager->rollback();
            throw $ex;
        }
    }

    public function changeFirstName(string $userId, string $firstName): string
    {
        //get user from repo or fail
        if (!$user = $this->userRepository->ofId(UserId::fromString($userId))) {
            throw new UserDoesNotExistException();
        }

        // modify first name
        $user->changeFirstName(FirstName::fromString($firstName));

        // save user
        $this->transactionManager->beginTransaction();
        try {
            $this->userRepository->add($user);

            $this->transactionManager->commit();

            return $user->userId()->toString();
        } catch (\Exception $ex) {
            $this->transactionManager->rollback();
            throw $ex;
        }
    }
}
