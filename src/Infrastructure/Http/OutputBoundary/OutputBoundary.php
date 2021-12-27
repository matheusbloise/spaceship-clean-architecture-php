<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\OutputBoundary;

use App\Domain\Entity\BaseEntity;

abstract class OutputBoundary
{
    abstract public static function toArray(BaseEntity $entity): array;

    public static function handle(string $message, array $data = []): array
    {
        return [
            'message' => $message,
            'data' => $data,
        ];
    }
}
