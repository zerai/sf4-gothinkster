<?php

declare(strict_types=1);

namespace SharedKernel\Domain;

interface TransactionManager
{
    public function commit(): void;
}
