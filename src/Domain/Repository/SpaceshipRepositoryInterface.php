<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Spaceship;

interface SpaceshipRepositoryInterface
{
    /**
     * @return array{id: string, name: string, engine: string}
     */
    public function findAll(): array;

    /**
     * @return array{id: string, name: string, engine: string}
     */
    public function findById(string $guid): array;

    public function remove(string $guid): bool;

    public function store(Spaceship $spaceship): Spaceship;

    public function update(Spaceship $spaceship, string $guid): Spaceship;
}
