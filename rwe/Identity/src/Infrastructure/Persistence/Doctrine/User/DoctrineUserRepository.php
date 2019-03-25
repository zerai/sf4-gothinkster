<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Persistence\Doctrine\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Identity\Domain\Model\User\Email;
use Identity\Domain\Model\User\User;
use Identity\Domain\Model\User\UserId;
use Identity\Domain\Model\User\UserRepository;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method User|null findOneByUuid(UuidInterface|UserId $uuid, array $orderBy = null)
 * @method User[]    findByUuid(UuidInterface|UserId $uuid, array $orderBy = null)
 * @method User|null findOneByEmail(Email $email, array $orderBy = null)
 */
class DoctrineUserRepository extends ServiceEntityRepository implements UserRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Saves given user.
     *
     * @param User $user User to save
     */
    public function add(User $user): void
    {
        // TODO: Implement add() method.
        //$this->persist($user);
        //$this->getEntityManager()->persist($user);
        //$this->getEntityManager()->flush($user);
        $this->_em->persist($user);
        //$this->_em->flush($user);
    }

    /**
     * List all users.
     *
     * @return User[] List of all User
     */
    public function getAll(): array
    {
        // TODO: Implement getAll() method.
        return $this->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function ofEmail(string $email): ?User
    {
        // TODO: Implement ofEmail() method.
        return $this->findOneBy(['email']);
    }

    /**
     * {@inheritdoc}
     */
    public function nextIdentity(): UserId
    {
        return UserId::generate();
    }

    /**
     * {@inheritdoc}
     */
    public function ofId(UserId $userId)
    {
        return $this->find($userId);
    }

    /**
     * Saves given user.
     *
     * @param User $user User to save
     */
    public function save(User $user): void
    {
        $this->_em->persist($user);
        //$this->_em->flush($user);
    }
}
