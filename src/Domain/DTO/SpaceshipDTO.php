<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\Entity\Spaceship;

class SpaceshipDTO implements DTO
{
    /**
     * @param array{guid: ?string, name: string, engine: string} $data
     * @return Spaceship
     */
    public static function toEntity(array $data): Spaceship
    {
        $guid = $data['guid'] ?? null;
        return new Spaceship($guid, $data['name'], $data['engine']);
    }
}
