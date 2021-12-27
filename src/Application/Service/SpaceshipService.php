<?php declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\DTO\SpaceshipDTO;
use App\Domain\Entity\Spaceship;
use App\Application\Exception\EntityNotFound;
use App\Domain\Repository\SpaceshipRepositoryInterface;

final class SpaceshipService
{
    private SpaceshipRepositoryInterface $repository;

    public function __construct(SpaceshipRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findByGuid(string $id): array
    {
        return $this->repository->findByGuid($id);
    }

    /**
     * @throws EntityNotFound
     */
    public function remove(string $guid): void
    {
        $this->repository->findByGuid($guid)
            ? $this->repository->remove($guid)
            : throw new EntityNotFound;
    }

    public function store(array $data): Spaceship
    {
        $spaceship = SpaceshipDTO::toEntity($data);
        return $this->repository->store($spaceship);
    }

    public function update(array $data, string $guid): Spaceship
    {
        $spaceship = SpaceshipDTO::toEntity($data);
        $this->repository->update($spaceship, $guid);
        return $spaceship;
    }
}
