<?php declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\Entity\Spaceship;

class SpaceshipDTO implements DTO
{
    /**
     * @@param array{int, Spaceship} $data
     * @return Spaceship
     */
    public static function toEntity(array $data): Spaceship
    {
        return new Spaceship(
            guid: $data['guid'] ?? null,
            name: $data['name'],
            engine: $data['engine']
        );
    }
}