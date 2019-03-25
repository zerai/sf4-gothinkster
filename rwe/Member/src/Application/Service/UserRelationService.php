<?php

declare(strict_types=1);

namespace Member\Application\Service;

use Ddd\Application\Service\ApplicationService;
use Identity\Domain\Model\User\Exception\UserDoesNotExistException;
use Member\Domain\Model\User\UserId;
use Member\Domain\Model\User\UserRelationRepository;

abstract class UserRelationService implements ApplicationService
{
    /**
     * @var UserRelationRepository
     */
    protected $userRelationRepository;

    /**
     * UserService constructor.
     *
     * @param UserRelationRepository $userRelationRepository
     */
    public function __construct(UserRelationRepository $userRelationRepository)
    {
        $this->userRelationRepository = $userRelationRepository;
    }

    protected function findUserOrFail($userId)
    {
//        $user = $this->userRepository->ofId(UserId::fromString($userId));
//        if (null === $user) {
//            throw new UserDoesNotExistException();
//        }

        //TODO: check
        if (!$userRelation = $this->userRelationRepository->ofId(UserId::fromString($userId))) {
            //TODO: warning use exception of other context
            throw new UserDoesNotExistException();
        }

        return $userRelation;
    }
}
