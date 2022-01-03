<?php

namespace App\Integration\Infrastructure\Http\OutputBoundary;

use App\Infrastructure\Http\OutputBoundary\OutputBoundary;
use PHPUnit\Framework\TestCase;

class OutputBoundaryTest extends TestCase
{
    public function testHandle(): void
    {
        $output = OutputBoundary::handle('Hello from Symfony', ['everything is ok']);
        self::assertEquals([
            'message' => 'Hello from Symfony',
            'data' => ['everything is ok']
        ], $output);
    }
}
