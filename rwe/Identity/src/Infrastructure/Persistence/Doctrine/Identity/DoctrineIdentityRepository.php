<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Persistence\Doctrine\Identity;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Identity\Domain\Model\Identity\Identity;
use Identity\Domain\Model\Identity\IdentityId;
use Identity\Domain\Model\Identity\IdentityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DoctrineIdentityRepository extends ServiceEntityRepository implements IdentityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Identity::class);
    }

    public function add(Identity $identity): void
    {
        $this->getEntityManager()->persist($identity);
        $this->getEntityManager()->flush($identity);
    }

    /**
     * {@inheritdoc}
     */
    public function getNextIdentityId(): IdentityId
    {
        return IdentityId::generate();
    }

    /**
     * {@inheritdoc}
     */
    public function nextIdentity(): IdentityId
    {
        return IdentityId::generate();
    }
}
