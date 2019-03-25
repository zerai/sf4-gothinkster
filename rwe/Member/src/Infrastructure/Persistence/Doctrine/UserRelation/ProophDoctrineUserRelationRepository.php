<?php

declare(strict_types=1);

namespace Member\Infrastructure\Persistence\Doctrine\UserRelation;

use ArrayIterator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Member\Domain\Model\User\Event\UserWasMarkedAsFollowed;
use Member\Domain\Model\User\UserId;
use Member\Domain\Model\User\UserRelation;
use Member\Domain\Model\User\UserRelationRepository;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\StreamName;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserRelation|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserRelation|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserRelation[]    findAll()
 * @method UserRelation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method UserRelation|null findOneByUuid(UuidInterface|UserId $uuid, array $orderBy = null)
 * @method UserRelation[]    findByUuid(UuidInterface|UserId $uuid, array $orderBy = null)
 */
class ProophDoctrineUserRelationRepository extends ServiceEntityRepository implements UserRelationRepository
{
    /**
     * @var EventStore
     */
    protected $eventStore;

    /**
     * @var StreamName
     */
    protected $streamName;

    public function __construct(RegistryInterface $registry, EventStore $eventStore, StreamName $streamName = null)
    {
        $this->eventStore = $eventStore;

        $this->streamName = $streamName;

        parent::__construct($registry, UserRelation::class);
    }

    public function save(UserRelation $userRelation): void
    {
        $this->_em->persist($userRelation);
        $this->_em->flush($userRelation);
        $enrichedEvents = [
            UserWasMarkedAsFollowed::with('xxx', 'xxx'),
            UserWasMarkedAsFollowed::with('yyy', 'yyy'),
        ];

        $enrichedEvents = $userRelation->popRecordedEvents();
        //$enrichedEvents[] = var_dump($userRelation->popRecordedEvents());

        $this->eventStore->appendTo($this->streamName, new ArrayIterator($enrichedEvents));
    }

    public function ofId(UserId $userId)
    {
        return $this->find($userId);
    }
}
