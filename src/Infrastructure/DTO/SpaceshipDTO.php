<?php declare(strict_types=1);

namespace App\Infrastructure\DTO;

use App\Domain\Entity\BaseEntity;
use App\Domain\Entity\Spaceship as SpaceshipEntity;
use App\Infrastructure\Persistence\Database\Model\Spaceship as SpaceshipModel;

class SpaceshipDTO implements DTO
{
    public static function toModel(SpaceshipEntity|BaseEntity $entity): SpaceshipModel
    {
        return (new SpaceshipModel())
            ->setId($entity->getGuid())
            ->setName($entity->getName())
            ->setEngine($entity->getEngine());
    }
}