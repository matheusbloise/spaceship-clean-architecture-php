<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Exception\EntityNotFound;
use App\Domain\DTO\SpaceshipDTO;
use App\Domain\Entity\Spaceship;
use App\Domain\Repository\SpaceshipRepositoryInterface;

final class SpaceshipService
{
    private SpaceshipRepositoryInterface $repository;

    public function __construct(SpaceshipRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array{guid: string, name: string, engine: string}
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @param string $id
     * @return array{guid: string, name: string, engine: string}
     */
    public function findByGuid(string $id): array
    {
        return $this->repository->findByGuid($id);
    }

    /**
     * @throws EntityNotFound
     */
    public function remove(string $guid): void
    {
        count($this->repository->findByGuid($guid)) == 1
            ? $this->repository->remove($guid)
            : throw new EntityNotFound();
    }

    /**
     * @param array{guid: string, name: string, engine: string} $data
     * @return Spaceship
     */
    public function store(array $data): Spaceship
    {
        $spaceship = SpaceshipDTO::toEntity($data);
        return $this->repository->store($spaceship);
    }

    /**
     * @param array{guid: string, name: string, engine: string} $data
     * @param string $guid
     * @return Spaceship
     */
    public function update(array $data, string $guid): Spaceship
    {
        $spaceship = SpaceshipDTO::toEntity($data);
        $this->repository->update($spaceship, $guid);
        return $spaceship;
    }
}
