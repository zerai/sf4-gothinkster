<?php

declare(strict_types=1);

namespace Member\Application\Service;

use Ddd\Application\Service\ApplicationService;
use Identity\Domain\Model\User\Exception\UserDoesNotExistException;
use Member\Domain\Model\User\Event\UserWasMarkedAsFollowed;
use Member\Domain\Model\User\UserId;
use Member\Domain\Model\User\UserRelation;
use Member\Domain\Model\User\UserRelationRepository;
use Symfony\Component\Messenger\MessageBusInterface;

class FollowUserService implements ApplicationService
{
    /** @var UserRelationRepository */
    private $userRelationRepository;

    /** @var MessageBusInterface */
    private $eventBus;

    /**
     * FollowUserService constructor.
     *
     * @param UserRelationRepository $userRelationRepository
     * @param MessageBusInterface    $eventBus
     */
    public function __construct(UserRelationRepository $userRelationRepository, MessageBusInterface $eventBus)
    {
        $this->userRelationRepository = $userRelationRepository;
        $this->eventBus = $eventBus;
    }

    /**
     * @param null $request
     *
     * @return mixed|string
     *
     * @throws UserDoesNotExistException
     */
    public function execute($request = null)
    {
        // TODO: Implement execute() method.
        if (!$userRelation = $this->userRelationRepository->ofId(UserId::fromString($request->userId()))) {
            //throw new UserDoesNotExistException();
            $userRelation = new UserRelation(UserId::fromString($request->userId()));
        }

        // add following user
        /* @var UserRelation $userRelation */
        $userRelation->addFollowingUser(UserId::fromString($request->followingUserId()));

        $this->userRelationRepository->save($userRelation);
//        $this->eventBus->dispatch(
//            UserWasMarkedAsFollowed::with($request->userId(), $request->followingUserId())
//        );

        return $userRelation->userId()->toString();
    }
}
