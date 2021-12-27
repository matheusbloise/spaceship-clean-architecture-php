<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\Entity\BaseEntity;
use App\Domain\Entity\Spaceship;

interface DTO
{
    /**
     * @param array<int, Spaceship> $data
     */
    public static function toEntity(array $data): BaseEntity;
}
