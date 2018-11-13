<?php

declare(strict_types=1);

namespace SharedKernel\Application\TransactionManager;

interface TransactionManager
{
    /**
     * Begin transaction.
     */
    public function begin(): void;

    /**
     * Commit transaction.
     */
    public function commit(): void;

    /**
     * Rollback transaction.
     */
    public function rollback(): void;
}
