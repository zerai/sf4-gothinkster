<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Application\Service;

use Ddd\Application\Service\ApplicationService;
use Ddd\Application\Service\TransactionalApplicationService;
use Ddd\Application\Service\TransactionalSession;

class TransationalApplicationFactory
{
    public static function createTransationalApplication(ApplicationService $applicationService, TransactionalSession $transactionalSession)
    {
        $transationalApplication = new TransactionalApplicationService($applicationService, $transactionalSession);

        return $transationalApplication;
    }
}
