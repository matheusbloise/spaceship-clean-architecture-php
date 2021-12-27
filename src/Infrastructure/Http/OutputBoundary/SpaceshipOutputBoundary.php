<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\OutputBoundary;

use App\Domain\Entity\BaseEntity;
use App\Domain\Entity\Spaceship;

final class SpaceshipOutputBoundary extends OutputBoundary
{
    public static function toArray(Spaceship|BaseEntity $entity): array
    {
        return [
            'id' => $entity->getGuid(),
            'name' => $entity->getName(),
            'engine' => $entity->getEngine(),
        ];
    }
}
