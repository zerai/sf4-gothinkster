<?php

declare(strict_types=1);

namespace Identity\Application;

use Identity\Domain\Model\User\User;
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
}
