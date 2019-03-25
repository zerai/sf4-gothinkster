<?php

declare(strict_types=1);

namespace SharedKernel\Domain;

interface Entity
{
    public function sameIdentityAs(Entity $other): bool;
}
