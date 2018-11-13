<?php

declare(strict_types=1);

namespace Identity\Application;

use Identity\Domain\Model\Identity\Email;
use Identity\Domain\Model\Identity\HashPassword;
use Identity\Domain\Model\Identity\Identity;
use Identity\Domain\Model\Identity\IdentityRepository;
use SharedKernel\Domain\TransactionManager;

class IdentityService
{
    /**
     * @var IdentityRepository
     */
    private $identityRepository;
    /**
     * @var TransactionManager
     */
    private $transactionManager;

    public function __construct(
        IdentityRepository $aIdentityRepository,
        TransactionManager $aTransactionManager
    ) {
        $this->identityRepository = $aIdentityRepository;
        $this->transactionManager = $aTransactionManager;
    }

    public function NewIdentity(string $email, string $password): string
    {
        $identityId = $this->identityRepository->nextIdentity();

        //TODO: encript password  before...

        $identity = new Identity($identityId, Email::fromString($email), HashPassword::fromString($password));

        $this->transactionManager->beginTransaction();
        try {
            $this->identityRepository->add($identity);
            $this->transactionManager->commit();

            return $identityId->toString();
        } catch (\Exception $ex) {
            $this->transactionManager->rollback();
            throw $ex;
        }
    }
}
