<?php

declare(strict_types=1);

namespace App\Integration\Infrastructure\Http\OutputBoundary;

use App\Infrastructure\Http\OutputBoundary\OutputBoundary;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class OutputBoundaryTest extends TestCase
{
    public function testHandle(): void
    {
        self::assertEquals([
            'message' => 'Hello from Symfony',
            'data' => ['everything is ok'],
        ], OutputBoundary::handle('Hello from Symfony', ['everything is ok']));
    }
}
