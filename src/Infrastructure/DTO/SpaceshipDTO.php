<?php

declare(strict_types=1);

namespace App\Infrastructure\DTO;

use App\Domain\Entity\Spaceship as SpaceshipEntity;
use App\Infrastructure\Persistence\Database\Model\Spaceship as SpaceshipModel;

abstract class SpaceshipDTO
{
    public static function toModel(SpaceshipEntity $entity): SpaceshipModel
    {
        return (new SpaceshipModel())
            ->setId($entity->getGuid())
            ->setName($entity->getName())
            ->setEngine($entity->getEngine());
    }
}
