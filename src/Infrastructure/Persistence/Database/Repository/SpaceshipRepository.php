<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Database\Repository;

use App\Domain\Entity\Spaceship as SpaceshipEntity;
use App\Domain\Repository\SpaceshipRepositoryInterface;
use App\Infrastructure\DTO\SpaceshipDTO;
use App\Infrastructure\Persistence\Database\Model\Spaceship;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SpaceshipRepository extends ServiceEntityRepository implements SpaceshipRepositoryInterface
{
    public const TABLE_FROM = 'App:Spaceship';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Spaceship::class);
    }

    public function findAll(): array
    {
        $entityManager = $this->getEntityManager();
        return $entityManager
            ->createQueryBuilder()
            ->select('s.id, s.name, s.engine')
            ->from(self::TABLE_FROM, 's')
            ->getQuery()
            ->execute();
    }

    public function findByGuid(string $guid): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager
            ->createQueryBuilder()
            ->select('s.id, s.name, s.engine')
            ->from(self::TABLE_FROM, 's')
            ->where('s.id = :id')
            ->setParameter('id', $guid)
            ->getQuery()
            ->execute();

        return $query ? reset($query) : $query;
    }

    public function remove(string $guid): void
    {
        $this->getEntityManager()
            ->createQueryBuilder()
            ->delete(self::TABLE_FROM, 's')
            ->where('s.id = :guid')
            ->setParameter('guid', $guid)
            ->getQuery()
            ->execute();
    }

    public function store(SpaceshipEntity $spaceship): SpaceshipEntity
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist(SpaceshipDTO::toModel($spaceship));
        $entityManager->flush();
        return $spaceship;
    }

    public function update(SpaceshipEntity $spaceship, string $guid): SpaceshipEntity
    {
        $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->update(self::TABLE_FROM, 's')
            ->set('s.name', ':name')
            ->set('s.engine', ':engine')
            ->setParameter('name', $spaceship->getName())
            ->setParameter('engine', $spaceship->getEngine())
            ->where('s.id = :id')
            ->setParameter('id', $guid)
            ->getQuery()
            ->execute();
        return $spaceship;
    }
}
