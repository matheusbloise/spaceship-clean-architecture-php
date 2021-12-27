<?php declare(strict_types=1);

namespace App\Infrastructure\DTO;

use App\Domain\Entity\BaseEntity;

interface DTO
{
    public static function toModel(BaseEntity $entity): object;
}