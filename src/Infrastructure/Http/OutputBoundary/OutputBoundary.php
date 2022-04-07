<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\OutputBoundary;

abstract class OutputBoundary
{
    public static function handle(string $message, array $content = []): array
    {
        return [
            'message' => $message,
            'data' => $content,
        ];
    }
}
