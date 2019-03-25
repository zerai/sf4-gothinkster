<?php

declare(strict_types=1);

namespace Member\Infrastructure\Persistence\Doctrine\UserRelation;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Member\Domain\Model\User\UserId;
use Member\Domain\Model\User\UserRelation;
use Member\Domain\Model\User\UserRelationRepository;
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
class DoctrineUserRelationRepository extends ServiceEntityRepository implements UserRelationRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserRelation::class);
    }

    public function save(UserRelation $userRelation): void
    {
        $this->_em->persist($userRelation);
        $this->_em->flush($userRelation);
    }

    public function ofId(UserId $userId)
    {
        return $this->find($userId);
    }
}
