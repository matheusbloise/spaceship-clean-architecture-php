<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Spaceship;

interface SpaceshipRepositoryInterface
{
    /**
     * @return array{guid: string, name: string, engine: string}
     */
    public function findAll(): array;

    /**
     * @param string $guid
     * @return array{guid: string, name: string, engine: string}
     */
    public function findByGuid(string $guid): array;

    public function remove(string $guid): void;

    public function store(Spaceship $spaceship): Spaceship;

    public function update(Spaceship $spaceship, string $guid): Spaceship;
}
