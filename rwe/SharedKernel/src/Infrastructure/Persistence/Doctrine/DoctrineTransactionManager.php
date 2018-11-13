<?php

declare(strict_types=1);

namespace SharedKernel\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use SharedKernel\Domain\TransactionManager;

final class DoctrineTransactionManager implements TransactionManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $anEntityManager
     */
    public function __construct(EntityManager $anEntityManager)
    {
        $this->entityManager = $anEntityManager;
    }

    public function beginTransaction(): void
    {
        $this->entityManager->beginTransaction();
    }

    public function commit(): void
    {
        $this->entityManager->commit();
    }

    public function rollback(): void
    {
        $this->entityManager->rollback();
    }
}
