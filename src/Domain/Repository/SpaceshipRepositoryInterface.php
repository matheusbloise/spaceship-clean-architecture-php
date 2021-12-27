<?php declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Spaceship;

interface SpaceshipRepositoryInterface
{
    public function findAll(): array;
    public function findByGuid(string $guid): array;
    public function remove(string $guid): void;
    public function store(Spaceship $spaceship): Spaceship;
    public function update(Spaceship $spaceship, string $guid): Spaceship;
}