<?php

declare(strict_types=1);

namespace App\Infrastructure\DTO;

use App\Domain\Entity\Spaceship as SpaceshipEntity;
use App\Infrastructure\Persistence\Database\Model\Spaceship as SpaceshipModel;

abstract class SpaceshipDTO
{
    public static function toModel(SpaceshipEntity $entity): SpaceshipModel
    {
        return new SpaceshipModel($entity->getGuid(), $entity->getName(), $entity->getEngine());
    }

    /**
     * @return array{guid: string, name: string, engine: string}
     */
    public static function toArray(SpaceshipEntity $entity): array
    {
        return [
            'guid' => $entity->getGuid(),
            'name' => $entity->getName(),
            'engine' => $entity->getEngine(),
        ];
    }
}
