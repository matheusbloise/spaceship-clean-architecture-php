<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Domain\Entity\Spaceship;

final class SpaceshipDTO
{
    /**
     * @param array{guid?: string, name: string, engine: string} $spaceship
     * @return Spaceship
     */
    public static function toEntity(array $spaceship): Spaceship
    {
        return new Spaceship($spaceship['guid'] ?? null, $spaceship['name'], $spaceship['engine']);
    }
}
