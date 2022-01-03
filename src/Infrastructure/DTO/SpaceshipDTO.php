<?php

declare(strict_types=1);

namespace App\Infrastructure\DTO;

use App\Domain\Entity\Spaceship as SpaceshipEntity;
use App\Infrastructure\Persistence\Database\Model\Spaceship as SpaceshipModel;

abstract class SpaceshipDTO
{
    /**
     * @param SpaceshipEntity $entity
     * @return SpaceshipModel
     */
    public static function toModel(SpaceshipEntity $entity): SpaceshipModel
    {
        return (new SpaceshipModel())
            ->setId($entity->getGuid())
            ->setName($entity->getName())
            ->setEngine($entity->getEngine());
    }

    /**
     * @param SpaceshipEntity $entity
     * @return array{id: string, name: string, engine: string}
     */
    public static function toArray(SpaceshipEntity $entity): array
    {
        return [
            'id' => $entity->getGuid(),
            'name' => $entity->getName(),
            'engine' => $entity->getEngine(),
        ];
    }
}
